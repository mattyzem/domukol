<?php
namespace App\Presenters;

use Nette;
use App\Model;
use Nette\Security\Permission;
//use Nette\Http\User;
use Nette\Security\User;

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
  protected $database;
  protected $roles;
  public function __construct(Nette\Database\Context $database){
    $this -> database = $database;
  }

  public function isValidName($v){
    //Jméno může obsahovat písmena (vč. diakritiky), číslice, znaky _ . a mezeru při délce 3 až 25 znaků. Žádný ze znaků nesmí být použit víc než 2× za sebou. Na začátku či konci přezdívky mohou být použity pouze písmena, či číslice.
    return (bool) preg_match('~^(?!.*([a-zÀ-ž0-9\._ ])\1{2})((?:(?![×Þß÷þø])[a-zÀ-ž0-9])(?:(?![×Þß÷þø])[a-zÀ-ž0-9\._ ]){1,23}(?:(?![×Þß÷þø])[a-zÀ-ž0-9]))$~i', $v -> value);
  }

  public function startup(){
    parent::startup();

    $acl = new Nette\Security\Permission;

    $acl->addRole('user');
    $acl->addRole('admin', 'user');

    $acl->addResource('users');

    $acl->allow('user', 'users', 'show');
    $acl->allow('admin', Nette\Security\Permission::ALL, array('show', 'edit', 'delete', 'add'));

    $user = $this -> getUser();
    $user -> setAuthorizator($acl);
  }
}
