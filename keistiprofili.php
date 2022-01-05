<?php
  session_start();
  $link = $_GET['profile'];
if($_SESSION['useruid'] == $link || $_SESSION['usersAdmin'] == 'Yes') {

}
else {
  header("location: ../login.php");
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
  <div class = "userbox">
  <nav>
  <ul>
    <?php
    if(isset($_SESSION["useruid"])) {
          ?>
            </li><div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a href="../index.php">PRADŽIOS PUSLAPIS</a>
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
<form action="../inc/keistiprofili.inc.php" enctype="multipart/form-data" method="post">
  <?php
  include_once 'inc/dbh.inc.php';
  $link = $_GET['profile'];
  $sql = "SELECT * FROM users WHERE usersUid = '$link' LIMIT 1";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
          ?>
  <div class="imgcontainer">
    <img class="loginLogo" src="../images/profile/<?php echo $row["usersPicture"] ?>" alt="<?php echo $row["usersName"] ?>">
    <?php
      if(isset($_GET["error"])) {
        if($_GET["error"] == "emptyinput") {
          echo "<p style='color:red; text-align: center;'>Užpildykite visus langelius</p>";
        }
        else if($_GET["error"] == "stmtfailed") {
          echo "<p style='color:red; text-align: center;'>Klaida, bandykite dar kartą</p>";
        }
        else if($_GET["error"] == "none") {
          echo "<p style='color:green; text-align: center;'>Sėkmingai pakeitėte vartotojo duomenis!</p>";
        }
        else if($_GET["error"] == "TooLarge") {
          echo "<p style='color:red; text-align: center;'>Failas, kurį pasirinkote yra per didelis. (Max 4MB)</p>";
        }
        else if($_GET["error"] == "FileNotAllowed") {
          echo "<p style='color:red; text-align: center;'>Nepasirinkote profilio nuotraukos arba failas, kurį pasirinkote nėra nuotrauka, bandykite dar kartą.</p>";
        }
      }
    ?>
    <input type="file" name="usersPicture" id ="usersPicture">
  </div>
  <div class="container">
    <h1><label for="uname"><b>Vardas, pavardė:</b></label></h1> <br>
    <input type="text" name="usersName" id ="usersName" value="<?php echo $row["usersName"];?>"><br>
    <h1><label for="uname"><b>Vartotojo vardas:</b></label></h1> <br>
    <input type="text" name="usersUid" id ="usersUid" value="<?php echo $row["usersUid"];?>"><br>
    <h1><label for="uname"><b>El.pašto adresas:</b></label></h1> <br>
    <input type="text" name="usersEmail" id ="usersEmail" value="<?php echo $row["usersEmail"];?>"><br>
    <input type="hidden" id="keiciantisUid" name="keiciantisUid" value="<?php echo $row["usersUid"];?>"><br>
    <button class = "loginbutton" name="submit" type="submit">Išsaugoti duomenis</button><br>
  </div>

  <?php
      } }
    ?>
  </div>
</form>
</body>
</html>
