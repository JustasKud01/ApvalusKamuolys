<?php
  session_start();
  if($_SESSION['usersAdmin'] == 'Yes') {
  }
  else {
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
  <link href="../style.css" rel="stylesheet">
  <link rel="shortcut icon" href="../logo.png" />
</head>
<body>
  <nav>
  <ul>
    <?php
    if(isset($_SESSION["useruid"])) {
          ?>
            </li><div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a href="../index.php">NAUJIENOS</a>
                    <a href="../rezultatai.php">REZULTATAI</a>
                    <a href="../tvarkarastis.php">TVARKARAŠTIS</a>
                    <a href='../profilis.php?profile=<?php echo $_SESSION['useruid'] ?>'>PROFILIS</a>
                <?php
                if($_SESSION['usersAdmin'] == 'Yes') {
                    echo "<a href='../adminpanel.php'>ADMIN PANEL</a>";
                }
                ?>
                <a href="../inc/logout.inc.php">ATSIJUNGTI</a>
              </div>
              <li><a><span style= "font-size: 26px;" style="" onclick="openNav()">&#9776;</span></a></li>

              <script>
              function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
              }

              function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
        }
          </script></li>
      <?php
      }
    ?>
  </ul>
</nav>
<form action="../inc/sukurtivartotoja.inc.php" method="post">
  <div class="imgcontainer">
    <img class="loginLogo" src="../logo.png" alt="logo">
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
        echo "<p style='color:green; text-align: center;'>Sėkmingai pridėjote naują vartotoją!</p>";
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
