<?php
if (isset($_POST["submit"])) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $username = $_POST["uid"];
  $pwd = $_POST["pwd"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputSignup($name, $email, $username, $pwd) !== false) {
    header("location: ../adminpanel/sukurtivartotoja.php?error=emptyinput");
    exit();
  }
  if (invalidUid($username) !== false) {
    header("location: ../adminpanel/sukurtivartotoja.php?error=invaliduid");
    exit();
  }
  if (invalidEmail($email) !== false) {
    header("location: ../adminpanel/sukurtivartotoja.php?error=invalidemail");
    exit();
  }
  if (uidExists($conn, $username, $email) !== false) {
    header("location: ../adminpanel/sukurtivartotoja.php?error=usernametaken");
    exit();
  }

  sukurtiVartotoja($conn, $name, $email, $username, $pwd);

}
  else {
    header("location: ../sukurtivartotoja.php");
    exit();
  }
 ?>
