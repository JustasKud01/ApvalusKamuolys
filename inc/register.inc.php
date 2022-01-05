<?php
if (isset($_POST["submit"])) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputSignup($name, $email, $username, $pwd) !== false) {
    header("location: ../registracija.php?error=emptyinput");
    exit();
  }
  if (invalidUid($username) !== false) {
    header("location: ../registracija.php?error=invaliduid");
    exit();
  }
  if (invalidEmail($email) !== false) {
    header("location: ../registracija.php?error=invalidemail");
    exit();
  }
  if (uidExists($conn, $username, $email) !== false) {
    header("location: ../registracija.php?error=usernametaken");
    exit();
  }

  createUser($conn, $name, $email, $username, $pwd);

}
  else {
    header("location: ../registracija.php");
    exit();
  }
 ?>
