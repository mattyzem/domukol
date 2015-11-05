<?php
namespace App\Presenters;

use App\Controls\Grido\Grid;
use Nette\Utils\Html;
use Nette;
use App\Model;
use Nette\Application\UI;
use Nette\Database\Context;

class LoginPresenter extends BasePresenter {
  protected function createComponentLoginForm(){
    $form = new UI\Form;
    $form -> addText('name', 'Jméno:')
          -> addRule(array($this, 'isValidName'), 'Vložte, prosím, Vaše platné přihlašovací jméno.')
          -> setRequired('Vložte, prosím, Vaše jméno.')
          -> setAttribute('autofocus')
          -> setAttribute('class', 'form-control')
          -> setAttribute('placeholder', 'Jméno');
    $form -> addPassword('password', 'Heslo:')
          -> addRule(UI\Form::MIN_LENGTH, 'Vložte, prosím, Vaše heslo.', 3)
          -> setRequired('Vložte, prosím, Vaše heslo.')
          -> setAttribute('class', 'form-control')
          -> setAttribute('placeholder', 'Heslo');
    $form -> addSubmit('signin', 'Přihlásit')
          -> setAttribute('class', 'btn btn-lg btn-primary btn-block');

    $form -> onSuccess[] = array($this, 'loginFormSucceeded');
    return $form;
  }

  public function loginFormSucceeded(UI\Form $form, $values){
    try {
      $this->getUser()->login($values->name, $values->password);
      //$user = $this->getUser();
      //die("Přihlášen!");
      $this->redirect('Users:show');
    }catch(Nette\Security\AuthenticationException $e){
      $form->addError($e->getMessage());
      return;
    }
    //$this->redirect('this');
    $this -> terminate();
  }

  public function startup(){
    parent::startup();
    $acl = new Nette\Security\Permission;

    $acl->addRole('guest');
    $acl->addRole('user');
    $acl->addRole('admin');

    $acl->addResource('users');

    $acl->deny('guest');
    $acl->allow('user', 'users', 'show');
    $acl->allow('admin', Nette\Security\Permission::ALL, array('show', 'edit', 'delete', 'add'));
    //die(var_dump($acl));
    //die(var_dump($this -> getUser() -> getRoles()));
  }
  public function beforeRender(){
    $this -> template -> user = $this->getUser();
  }
}
