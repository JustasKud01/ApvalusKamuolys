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
  <link href="style.css" rel="stylesheet">
  <link rel="shortcut icon" href="logo.png" />
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
  <div class="imgcontainer">
    <img class="loginLogo" src="logo.png" alt="logo">
  </div>
  <h1 style="text-align: center;">Sveiki prisijungę prie AdminPanel</h1>
  </div>
    <div class "btn-group">
      <a href="adminpanel/sukurtivartotoja.php"><button class="btn-full">Sukurti naują vartotoją</button></a>
      <a href="adminpanel/sunaikintivartotoja.php"><button class="btn-full">Ištrinti vartotoją</button></a>
      <a href="adminpanel/pridetivarzybas.php"><button class="btn-full">Pridėti naujas varžybas į tvarkaraštį</button></a>
      <a href="adminpanel/pridetirezultatus.php"><button class="btn-full">Pridėti rezultatus</button></a>
      <a href="adminpanel/sukurtinaujiena.php"><button class="btn-full">Sukurti naujieną</button></a>
      <a href="adminpanel/pakeistislaptazodi.php"><button class="btn-full">Pakeisti slaptažodį</button></a>
    </div>
</body>
</html>
