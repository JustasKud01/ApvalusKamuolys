<?php
if (isset($_POST["submit"])) {
  $varzybos = $_POST["varzybulaikas"];
  $komanda1 = $_POST["komanda1"];
  $komanda2 = $_POST["komanda2"];
  $lyga = $_POST["lyga"];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  if (emptyInputSignup($varzybos, $komanda1, $komanda2, $lyga) !== false) {
    header("location: ../adminpanel/pridetirezultatus.php?error=emptyinput");
    exit();
  }

  pridetiVarzybas($conn, $varzybos, $komanda1, $komanda2, $lyga);

}
  else {
    header("location: ../adminpanel/pridetivarzybas.php");
    exit();
  }
 ?>
