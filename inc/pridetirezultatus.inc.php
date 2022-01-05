<?php
if (isset($_POST["submit"])) {
  $varzybos = $_POST["varzybulaikas"];
  $komanda1 = $_POST["komanda1"];
  $komanda2 = $_POST["komanda2"];
  $taskai = $_POST["taskai"];
  $lyga = $_POST["lyga"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputSignup($varzybos, $komanda1, $komanda2, $taskai, $lyga) !== false) {
    header("location: ../adminpanel/pridetirezultatus.php?error=emptyinput");
    exit();
  }

  pridetiRezultatus($conn, $varzybos, $komanda1, $komanda2, $taskai, $lyga);

}
  else {
    header("location: ../adminpanel/pridetirezultatus.php");
    exit();
  }
 ?>
