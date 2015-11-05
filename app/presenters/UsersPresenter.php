<?php
namespace App\Presenters;

use Nette;
use App\Controls\Grido\Grid;
use Nette\Utils\Html;
use Nette\Application\UI;
use Nette\Utils\Validators;
use App\Model;
use Nette\Security\Permission;
use Nette\Security\User;
class UsersPresenter extends BasePresenter {
    /** @var string @persistent */
    public $ajax = 'on';

    public $user;

    /** @var string @persistent */
    public $filterRenderType = \Grido\Components\Filters\Filter::RENDER_INNER;

    public function handleCloseTip(){
      $this->context->httpResponse->setCookie('grido-examples-first', 0, 0);
      $this->redirect('this');
    }

    public function startup(){
      parent::startup();
      $user = $this -> getUser();
      if(!$user -> isLoggedIn())
        $this -> redirect('Login:login');
      if(!$this->getUser()->isAllowed('users', $this -> getParameter("action")))
        $this -> redirect('Login:login');
    }

    protected function createComponentGrid($name){
      $user = $this->getUser();
      if(!$user->isLoggedIn())
        $this->redirect('Login');


      $grid = new Grid($this, $name);
      $grid -> model = $this->database->table('users');

      $grid -> addColumnText('name', 'Jméno')
            -> setSortable()
            -> setFilterText()
            -> setSuggestion();

      $grid -> addColumnText('role', 'Oprávnění')
            -> setReplacement(array('admin' => Html::el('b')->setText('Administrátoris'), 'user' => 'Uživatel'))
            -> setSortable()
            -> setFilterText()
            -> setSuggestion();

      $grid -> addColumnEmail('mail', 'E-mail')
            -> setSortable()
            -> setFilterText();
      $grid -> getColumn('mail')
            -> cellPrototype
            -> class[] = 'center';

      if($this->getUser()->isAllowed('users', 'edit'))
        $grid -> addActionHref('edit', 'Upravit')
              -> setIcon('pencil');

      if($this->getUser()->isAllowed('users', 'delete'))
        $grid -> addActionHref('delete', 'Smazat')
              -> setIcon('trash')
              -> setConfirm(function($item) {
                   return "Vážně chcete smazat uživatele {$item->name}?";
                 });

      $operation = array('delete' => 'Smazat');
      $grid -> setOperation($operation, $this -> handleOperations)
            -> setConfirm('delete', 'Vážně chcete smazat %i uživatelů?');

      $grid -> filterRenderType = $this -> filterRenderType;
    }

    /**
     * Common handler for grid operations.
     * @param string $operation
     * @param array $id
     */
    public function handleOperations($operation, $id){
      $this -> actionDelete($id);
    }

    protected function createComponentUserForm(){
      $act = $this -> getParameter("action");
      $id = $this -> getParameter("id");


      $form = new UI\Form;

      $data = false;
      if($act == "edit"){
        $data = $this -> database -> table("users") -> get($id);
        $form -> addHidden('userID', $data ? $data -> id : null);
        /*if(!$data)
          $this -> redirect("Users:show");*/
        // Nechápu proč mi formulář v actionu maže ID?
        // Po odkomentování se ovšem neprovede userFormSucceeded() - jen se odešlou data na stejnou stránku bez zpracování
        //$form->setAction($this->link("Users:edit", array("id"=>$id)));
      }


      $form -> addText('name', 'Jméno:')
            -> setAttribute('class', 'form-control')
            -> setAttribute('placeholder', 'Jméno')
            -> addRule(array($this, 'isValidName'), 'Jméno může obsahovat písmena (vč. diakritiky), číslice, znaky _ . a mezeru při délce 3 až 25 znaků. Žádný ze znaků nesmí být použit víc než 2× za sebou. Na začátku či konci přezdívky mohou být použity pouze písmena, či číslice.');

      $form -> addText('email', 'E-mail:')
            -> setType('email')
            -> addRule(UI\Form::EMAIL, 'Vložte prosím platnou e-mailovou adresu')
            -> setAttribute('class', 'form-control')
            -> setAttribute('placeholder', 'E-mail');
      $form -> addPassword('password', 'Heslo:')
            -> setAttribute('class', 'form-control')
            -> setAttribute('placeholder', 'Heslo');
      $form -> addPassword('password2', 'Heslo znovu:')
            -> addRule(UI\Form::EQUAL, 'Hesla se neshodují!', $form['password'])
            -> setAttribute('class', 'form-control')
            -> setAttribute('placeholder', 'Heslo');
      // Nepodařilo se mi najít možnost jak získat seznam všech oprávnění
      $roles = array(0=>'Uživatel', 1=>'Administrátor');
      $form -> addSelect('role', 'Oprávnění:', $roles)
            -> setPrompt('Zvolte oprávnění');
      $form -> addSubmit('doit', $act=='edit' ? 'Upravit uživatele' : 'Vytvořit uživatele')
            -> setAttribute('class', 'btn btn-lg btn-primary btn-block');

      //die(var_dump($form));

      if($data){
        $form["name"] -> setAttribute('value', $data -> name);
        $form["email"] -> setAttribute('value', $data -> mail);
        // Nechápu proč mi formulář v actionu maže ID?
      }elseif($act=="add")
        $form["password"] -> addRule(UI\Form::MIN_LENGTH, 'Je nám líto, ale Vaše nové heslo musí obsahovat minimálně osm znaků, jedno velké písmeno, tři číslice, symbol, inspirující poselství, hieroglyf, znak gangu a krev jednorožce. (ne sranda, 3 znaky stačí)', 3);


      $form -> onSuccess[] = array($this, 'userFormSucceeded');

      return $form;
    }

    function userFormSucceeded(UI\Form $form, $values){
      //die(var_dump($values));
      $act = $this -> getParameter("action");
      $id = $act=="edit"? $values->userID : $this -> getParameter("id");
      $dat = array();
      // Nepodařilo se mi najít možnost jak získat seznam všech oprávnění
      $roles = array(0=>'user', 1=>'admin');



      // Editace uživatele
      if($act == "edit"){
        if(!$this->getUser()->isAllowed('users', 'edit'))
          $this -> redirect("Users:show");

        $data = $this -> database -> table("users") -> get($id);
        if(!$data)
          $this -> redirect("Users:show");

        // Existující uživatel
        if($data -> name != $values -> name){
          $e = $this -> database -> table("users") -> where("name", $values -> name);
          if($e)
            $form -> addError("Uživatel s tímto jménem již existuje!");
          else
            $dat["password"] = password_hash($values -> name . $data -> password, PASSWORD_DEFAULT);
        }

        // Existující e-mail
        if($data -> mail != $values -> email){
          $e = $this -> database -> table("users") -> where("mail", $values -> email);
          if($e)
            $form -> addError("Uživatel s tímto e-mailem již existuje!");
        }

        $dat["name"] = $values -> name;
        $dat["mail"] = $values -> email;
        if(!empty($values -> password))
          $dat["password"] = password_hash($values -> name . $values -> password, PASSWORD_DEFAULT);
        if($values -> role != NULL)
          $dat["role"] = $roles[$values -> role];


        $this -> database -> query("UPDATE users SET ? WHERE id = ?", $dat, $id);
        $this -> flashMessage("Uživatel byl úspěšně upraven.", 'success');
        $this -> redirect('Users:show');
        $this -> terminate();
      }elseif($act == "add"){


        if(!$this->getUser()->isAllowed('users', 'add'))
          $this -> redirect("Users:show");
        // Vytvoření nového uživatele
          // Existující uživatel
          $e = $this -> database -> table("users") -> where("name", $values -> name);
          if($e)
            $form -> addError("Uživatel s tímto jménem již existuje!");
          // Existující e-mail
          $e = $this -> database -> table("users") -> where("mail", $values -> email);
          if($e)
            $form -> addError("Uživatel s tímto e-mailem již existuje!");


        $dat["name"] = $values -> name;
        $dat["mail"] = $values -> email;
        $dat["password"] = password_hash($values -> name . $values -> password, PASSWORD_DEFAULT);
        $dat["role"] = $values -> role == NULL ? $roles[0] : $roles[$values -> role];

        $this -> database -> query("INSERT INTO users", $dat);
        $this -> flashMessage("Uživatel byl úspěšně vytvořen.", 'success');
        $this -> redirect('Users:show');
      }
    }


    public function actionDelete($id=null){
      if(!$this->getUser()->isAllowed('users', 'delete'))
        $this -> redirect("Users:show");


      $id = !empty($id) ? $id : $this -> getParameter('id');
      // Pokus o smazání sebe samého
      if(is_array($id) && in_array($user -> id, $id)){
        $this->flashMessage("Sebe samého smazat nemůžete!", 'success');
        $this->redirect('Users:show');
      }

      $id = is_array($id) ? implode(', ', $id) : $id;
      $this -> database -> query("DELETE FROM users WHERE id IN (?)", $id);

      $this->flashMessage("Uživatel byl úspěšně smazán.", 'success');
      $this->redirect('Users:show');
    }

    public function renderDefault()
    {
        $this['grid']; //WORKAROUND! A better visualization of the error 500..
    }

    /**********************************************************************************************/

    protected function createTemplate($class = NULL)
    {
        $template = parent::createTemplate();
        $latte = $template->getLatte();

        $set = new \Latte\Macros\MacroSet($latte->getCompiler());
        $set->addMacro('scache', '?>?<?php echo strtotime(date(\'Y-m-d hh \')); ?><?php');
        $latte->addFilter('scache', $set);
        return $template;
    }

    public function beforeRender()
    {
        $this -> template -> baseUri = $this->template->basePath;
        $this -> template -> first = $this->context->httpRequest->getCookie('grido-examples-first', 1);
    }
}
