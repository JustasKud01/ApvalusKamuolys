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
<form action="../inc/pakeistislaptazodi.inc.php" method="post">
  <div class="imgcontainer">
    <img class="loginLogo" src="../logo.png" alt="logo">
  </div>
  <?php
    if(isset($_GET["error"])) {
      if($_GET["error"] == "emptyinput") {
        echo "<p style='color:red; text-align: center;'>Užpildykite visus langelius</p>";
      }
      else if($_GET["error"] == "stmtfailed") {
        echo "<p style='color:red; text-align: center;'>Klaida, bandykite dar kartą</p>";
      }
      else if($_GET["error"] == "none") {
        echo "<p style='color:green; text-align: center;'>Sėkmingai pakeitėte vartotojo slaptažodį!</p>";
      }
      else if($_GET["error"] == "wronguser") {
        echo "<p style='color:red; text-align: center;'>Vartotojas tokiu vardu neegzistuoja!</p>";
      }
    }
  ?>
  <div class="container">
    <label for="uname"><b>Vartotojo vardas, kurio slaptažodį norite pakeisti</b></label>
    <input type="text" placeholder="Įveskite vartotojo vardą" name="username" id ="username">
    <label for="password"><b>Naujas slaptažodis</b></label>
    <input type="password" placeholder="Įveskite slaptažodį" name="pwd" id ="pwd" required>
    <label for="uname"><b>Ar suteikti vartotojui adminstracines teises?</b></label>
    <select class="lygos" name="isadmin" id="isadmin">
      <option value="No">Ne</option>
      <option value="Yes">Taip</option>
    </select>
    <button class = "loginbutton" name="submit" type="submit">Pakeisti slaptažodį</button>
  </div>

</form>
</body>
</html>
