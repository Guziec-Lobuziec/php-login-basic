<?php

  require '../dao/userRepo.php';

  $login = $_POST["login"];
  $password = $_POST["password"];

  $dbh = new PDO('mysql:host=db;dbname=login_db', 'root', 'root');
  $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $repo = new UserRepo($dbh);

  $user = $repo->getUser($login);



  $responseData = "";

  if($user) {
    if($user->checkPassword($password)){
      $responseData = ['login' => 0, 'message'=>'Zalogowano'];
    } else {
      $responseData = ['login' => 1, 'message'=>'Nieprawidłowe hasło'];
    }
  } else {
    $responseData = ['login' => 2, 'message'=>'Nieprawidłowy login'];
  }

  header('Content-type: application/json');
  echo json_encode( $responseData );

?>
