<?php

class User {

  private $login;
  private $passwordSHA256;
  private $salt;

  public function checkPassword($password) {
    $hash = hash("sha256", $password.($this->salt), TRUE);
    if($hash == ($this->passwordSHA256)) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function setPassword($password) {
    $salt = random_bytes(32);
    $this->passwordSHA256 = hash("sha256", $password.$salt, TRUE);
    $this->salt = $salt;
  }

  public function getLogin() {
    return $this->login;
  }

  public function getPasswordSHA256() {
    return $this->passwordSHA256;
  }

  public function getSalt() {
    return $this->salt;
  }

  public function setLogin($login) {
    $this->login = $login;
  }

  public function setPasswordSHA256($passwordSHA256) {
    $this->passwordSHA256 = $passwordSHA256;
  }

  public function setSalt($salt) {
    $this->salt = $salt;
  }

}

?>
