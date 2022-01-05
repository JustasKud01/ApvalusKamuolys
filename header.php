<html>

<?php
  session_start();
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta charset="utf-8">
  <meta name ="author" content="Justas">
  <title>Apvalus Kamuolys</title>
  <link href="style.css" rel="stylesheet">
  <link rel="shortcut icon" href="logo.png">
</head>

<body>
  <script src="js/script.js"></script>
  <div id="wrapper"></div>
  <header>
    <nav>
    <a href="index.php"><img src="logo.png" class="logo" alt="ApvalusKamuolys" width="90" height="90"><a>
    <ul>
    <li><a href="index.php">Naujienos</a></li>
    <li><a href="rezultatai.php">Rezultatai</a></li>
    <li><a href="tvarkarastis.php">Tvarkaraštis</a></li>
    <?php
    if(!isset($_SESSION["useruid"])) {
        echo "<li><a href='login.php'>Prisijungti</a></li>";
    } ?>
    <li><div id="demo"></div></li>
    <?php
    if(isset($_SESSION["useruid"])) {
          ?>
            </li><div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a href='profilis.php?profile=<?php echo $_SESSION['useruid'] ?>'>Profilis</a>
                <?php
                if($_SESSION['usersAdmin'] == 'Yes') {
                    echo "<a href='adminpanel.php'>Admin panel</a>";
                }
                ?>
                <a href="inc/logout.inc.php">Atsijungti</a>
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
</header>
  <hr class= "hrtop" style="width:100%;text-align:left;margin-left:0">
</body>
</html>
