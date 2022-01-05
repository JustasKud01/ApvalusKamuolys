<?php
  session_start();

if(isset($_SESSION["useruid"])) {
  header("location: ../index.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name ="author" content="Justas">
  <title>Apvalus Kamuolys</title>
  <link href="style.css" rel="stylesheet">
  <link rel="shortcut icon" href="logo.png" />
</head>
<body>
<nav>
  <ul>
  <li><a href="index.php">PRADŽIOS PUSLAPIS</a></li>
  <li><a href="registracija.php">REGISTRACIJA</a></li>
  <li><div id="demo"></div></li>
  </ul>
</nav>


<form action="inc/login.inc.php" method="post">
  <div class="imgcontainer">
    <img class="loginLogo" src="logo.png" alt="logo">
  </div>

<?php
    if(isset($_GET["error"])) {
      if($_GET["error"] == "emptyinput") {
        echo "<p style='color:red; text-align: center;'>Užpildykite visus langelius</p>";
      }
      else if($_GET["error"] == "wronglogin") {
        echo "<p style='color:red; text-align: center;'>Netinkamas prisijungimo vardas arba slaptažodis, bandykite dar kartą</p>";
      }
      else if($_GET["error"] == "isAdmin") {
        echo "<p style='color:red; text-align: center;'>Jūs esate administratorius. Prašome prisijungti per adminpanel!</p>";
      }
    }
  ?>
  <div class="container">
    <label for="uname"><b>Prisijungimo vardas</b></label>
    <input type="text" placeholder="Įveskite prisijungimo vardą" name="uid">

    <label for="psw"><b>Slaptažodis</b></label>
    <input type="password" placeholder="Įveskite slaptažodį" name="pwd">

    <button class = "loginbutton" type="submit" name="submit">Prisijungti</button>
  </div>
</form>

</body>
</html>
