<?php

  require '../dao/userRepo.php';

  $dbh = new PDO('mysql:host=db;dbname=login_db', 'root', 'root');
  $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $repo = new UserRepo($dbh);

  $repo -> create();

?>
