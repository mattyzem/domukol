<?php
use Nette\Security;

class MyAuthenticator extends Nette\Object implements Nette\Security\IAuthenticator {
  protected $database;
  public function __construct(Nette\Database\Context $database){
    $this->database = $database;
  }

  public function authenticate(array $credentials){
    $username = $credentials[self::USERNAME];
    $password = password_hash($credentials[self::PASSWORD] . $credentials[self::USERNAME], PASSWORD_DEFAULT);

    $row = $this->database->query("SELECT id,name,password,role FROM users WHERE name=?", $username);

    if(!$row->getRowCount()) { // uživatel nenalezen
      throw new Nette\Security\AuthenticationException("Neplatné uživatelské jméno nebo heslo.", self::IDENTITY_NOT_FOUND);
    }

    $row = $row->fetch();

    if(!password_verify($credentials[self::PASSWORD] . $credentials[self::USERNAME], $password)) { // hesla se neshodují
      throw new Nette\Security\AuthenticationException("Neplatné uživatelské jméno nebo heslo.", self::INVALID_CREDENTIAL);
    }

    return new Nette\Security\Identity($row->id, $row->role, array('name' => $row->name)); // vrátíme identitu
  }
}
