<?php
  session_start();

if (isset($_POST["submit"])) {
  $commentcontent = $_POST["title"];
  $usersUid = $_SESSION["useruid"];
  $link = $_POST["link"];


  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyComment($commentcontent) !== false) {
    header("location: ../readmore.php?link=$link");
    exit();
  }
  pridetiKomentara($conn, $commentcontent, $usersUid, $link);

}
  else {
    header("location: ../readmore.php?link=$link");
    exit();
  }
 ?>
