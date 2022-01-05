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
    <li><a href="login.php">PRISIJUNGTI</a></li>
    <li><div id="demo"></div></li>
    </ul>
  </nav>


<form action="inc/register.inc.php" method="post">
  <div class="imgcontainer">
    <img class="loginLogo" src="logo.png" alt="logo">
  </div>
  <?php
    if(isset($_GET["error"])) {
      if($_GET["error"] == "emptyinput") {
        echo "<p style='color:red; text-align: center;'>Užpildykite visus langelius</p>";
      }
      else if($_GET["error"] == "invaliduid") {
        echo "<p style='color:red; text-align: center;'>Patikrinkite prisijungimo vardą. Prisijungimo varde gali būti tik: a-z, A-Z, 0-9</p>";
      }
      else if($_GET["error"] == "invalidemail") {
        echo "<p style='color:red; text-align: center;'>Patikrinkite el.pašto adresą</p>";
      }
      else if($_GET["error"] == "stmtfailed") {
        echo "<p style='color:red; text-align: center;'>Klaida bandykite dar kartą</p>";
      }
      else if($_GET["error"] == "usernametaken") {
        echo "<p style='color:red; text-align: center;'>Šis vartotojo vardas jau egzistuoja</p>";
      }
      else if($_GET["error"] == "none") {
        echo "<p style='color:green; text-align: center;'>Sėkmingai prisiregistravote!</p>";
      }
    }
  ?>
  <div class="container">
    <label for="VardasPav"><b>Vardas, pavardė</b></label>
    <input type="text" placeholder="Įveskite savo pilną vardą" name="name" id ="name" required>
    <label for="username"><b>Registracijos vardas</b></label>
    <input type="text" placeholder="Įveskite registracijos vardą" name="uid" id ="uid" required>

    <label for="email"><b>Email adresas</b></label>
    <input type="email" placeholder="Įveskite email adresą" name="email" id ="email" required>

    <label for="password"><b>Slaptažodis</b></label>
    <input type="password" placeholder="Įveskite slaptažodį" name="pwd" id ="pwd" required>

    <button class = "loginbutton" name="submit" type="submit">Registruotis</button>
  </div>

</form>
</body>
</html>
