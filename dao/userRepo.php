<?php

require 'user.php';

class UserRepo {
  private static $create =
  'CREATE TABLE IF NOT EXISTS service_user('.
    'login varchar(255) NOT NULL,'.
    'pass_hash binary(32) NOT NULL,'.
    'salt binary(32) NOT NULL,'.
    'PRIMARY KEY (login))';

  private static $select =
  'SELECT * FROM service_user WHERE login = :login';

  private static $insert =
  'INSERT INTO service_user (login, pass_hash, salt) VALUES (?,?,?)';

  private $pdo;

  function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function setupTable() {

    $this->pdo->exec(self::$create);

  }

  public function getUser($login) {

    $sth = $this->pdo->prepare(self::$select, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array(':login' => $login));
    $data = $sth->fetchAll();
    if(empty($data)) {
      return FALSE;
    } else {
      $user = new User();
      $user->setLogin($data[0]['login']);
      $user->setPasswordSHA256($data[0]['pass_hash']);
      $user->setSalt($data[0]['salt']);
      return $user;
    }
  }

  public function addUser($user) {

    $stmt = $this->pdo->prepare(self::$insert);
    $stmt->execute([$user->login, $user->passwordSHA256, $user->salt]);
  }

}

?>
