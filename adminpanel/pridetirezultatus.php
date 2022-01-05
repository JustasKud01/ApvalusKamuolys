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
<form action="../inc/pridetirezultatus.inc.php" method="post">
  <div class="imgcontainer">
    <img class="loginLogo" src="../logo.png" alt="logo">
  </div>
  <?php
    if(isset($_GET["error"])) {
      if($_GET["error"] == "emptyinput") {
        echo "<p style='color:red; text-align: center;'>Užpildykite visus langelius</p>";
      }
      else if($_GET["error"] == "stmtfailed") {
        echo "<p style='color:red; text-align: center;'>Klaida bandykite dar kartą</p>";
      }
      else if($_GET["error"] == "none") {
        echo "<p style='color:green; text-align: center;'>Sėkmingai pridėjote rezultatus į duomenų bazę!</p>";
      }
    }
  ?>
  <div class="container">
      <label for="uname"><b>Varžybų laikas (data ir laikas):</b></label>
      <input class="lygos" type="datetime-local" id="varzybulaikas" name="varzybulaikas">
    <label for="uname"><b>1 komanda</b></label>
    <input type="text" placeholder="Įveskite komanda, kuri žaidžia" name="komanda1" id ="komanda1">
    <label for="uname"><b>2 komanda</b></label>
    <input type="text" placeholder="Įveskite kitą komanda, kuri žaidžia" name="komanda2" id ="komanda2">
    <label for="uname"><b>Taškai</b></label>
    <input type="text" placeholder="Įveskite kiek taškų sumetė komandos (taškai-taškai formatu)" name="taskai" id ="taskai">
    <label for="uname"><b>Lyga</b></label>
    <select  class="lygos" name="lyga" id="lyga">
      <option value="Eurolyga">Eurolyga</option>
      <option value="LKL">LKL</option>
      <option value="NKL">NKL</option>
      <option value="NBA">NBA</option>
    </select>
    <button class = "loginbutton" name="submit" type="submit">Pridėti naujus rezultatus</button>
  </div>

</form>
</body>
</html>
</html>
