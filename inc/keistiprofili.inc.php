<?php
if (isset($_POST["submit"])) {
  $usersPicture = $_FILES['usersPicture']['name'];
  $usersName = $_POST["usersName"];
  $usersUid = $_POST["usersUid"];
  $usersEmail = $_POST["usersEmail"];
  $keiciantisUid = $_POST["keiciantisUid"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';


  keistiProfili($conn, $usersPicture, $usersName, $usersUid, $usersEmail, $keiciantisUid);

}
  else {
    header("location: ../keistiprofili.php");
    exit();
  }
 ?>
