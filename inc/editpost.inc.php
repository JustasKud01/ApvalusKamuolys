<?php
if (isset($_POST["submit"])) {
  $title = $_POST["title"];
  $content = $_POST["content"];
  $link = $_GET['edit'];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';


  redaguotiPosta($conn, $title, $content, $link);
  
}
  else {
    header("location: ../edit.php?edit=$link");
    exit();
  }
 ?>
