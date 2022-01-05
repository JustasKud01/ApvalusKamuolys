<?php
session_start();
if (isset($_POST["submit"])) {
  $link = $_POST["link"];
  $title = $_POST["title"];
  $content = $_POST["content"];
  $images = $_FILES['foto']['name'];
  $usersUid = $_SESSION["useruid"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  pridetiNaujiena($conn, $link, $title, $content, $images, $usersUid);
}
  else {
    header("location: ../adminpanel/sukurtinaujiena.php");
    exit();
  }
 ?>
