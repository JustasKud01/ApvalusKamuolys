<?php
//Prisijungimas/Prisiregistravimas


//Paliktas tuščias langelis
function emptyInputSignup ($name, $email, $username, $pwd) {
  $result;
  if(empty($name) || empty($email) || empty($username) || empty($pwd)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}
//Įvestas username netinkamas
function invalidUid ($username) {
  $result;
  if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}
//Netinkamas email pašto adresas
function invalidEmail ($email) {
  $result;
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}
//Username, email jau egzistuoja
function uidExists ($conn, $username, $email) {
  $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../registracija.php?error=stmtfailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ss", $username, $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  }
  else {
    $result = false;
    return $result;
  }
  mysqli_stmt_close($stmt);
}
//Sukuria vartotoją registracijos būdu
function createUser ($conn, $name, $username, $email, $pwd) {
  $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../registracija.php?error=stmtfailed");
    exit();
  }
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ssss", $name, $username, $email, $hashedPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../registracija.php?error=none");
  exit();
}
// Prisijungiant paliktas tuščias langelis
function emptyInputLogin($username, $pwd) {
  $result;
  if(empty($username) || empty($pwd)) {
    $result = true;
  }
  else {
    $result = false;
  }
  return $result;
}
// Vartotojas prijungiamas prie svetainės
function loginUser($conn, $username, $pwd) {
  $sql = ("SELECT usersAdmin FROM users WHERE usersUid = '$username'");
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_row($result);
  $user = $row['0'];
  if ($user == "No") {
    $uidExists = uidExists($conn, $username, $username);
    if ($uidExists === false) {
      header("location: ../login.php?error=wronglogin");
      exit();
    }
    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
      header("location: ../login.php?error=wronglogin");
      exit();
    }
    else if ($checkPwd === true) {
      session_start();
      $_SESSION["userid"] = $uidExists["usersId"];
      $_SESSION["useruid"] = $uidExists["usersUid"];
      $_SESSION["usersAdmin"] = $uidExists["usersAdmin"];
      $_SESSION["usersPicture"] = $uidExists["usersPicture"];
      header("location: ../index.php");
      exit();
    }
  }
    else {
      header("location: ../login.php?error=isAdmin");
      exit();
    }
}
function adminloginUser($conn, $username, $pwd) {
  $sql = ("SELECT usersAdmin FROM users WHERE usersUid = '$username'");
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_row($result);
  $user = $row['0'];
  if ($user == "Yes") {
    $uidExists = uidExists($conn, $username, $username);
    if ($uidExists === false) {
      header("location: ../adminlogin.php?error=wronglogin");
      exit();
    }
    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
      header("location: ../adminlogin.php?error=wronglogin");
      exit();
    }
    else if ($checkPwd === true) {
      session_start();
      $_SESSION["userid"] = $uidExists["usersId"];
      $_SESSION["useruid"] = $uidExists["usersUid"];
      $_SESSION["usersAdmin"] = $uidExists["usersAdmin"];
      $_SESSION["usersPicture"] = $uidExists["usersPicture"];
      header("location: ../index.php");
      exit();
    }
  }
    else {
      header("location: ../adminlogin.php?error=notAdmin");
      exit();
    }
}


//Sukuria vartotoją per admin panel
function sukurtiVartotoja ($conn, $name, $username, $email, $pwd) {
  $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../adminpanel/sukurtivartotoja.php?error=stmtfailed");
    exit();
  }
  $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ssss", $name, $username, $email, $hashedPwd);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../adminpanel/sukurtivartotoja.php?error=none");
  exit();
}
//Prideda varžybas į tvarkaraštį
function pridetiVarzybas ($conn, $varzybos, $komanda1, $komanda2, $lyga) {
  $sql = "INSERT INTO tvarkarastis (VarzybuLaikas, komanda1, komanda2, lyga) VALUES (?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../adminpanel/pridetivarzybas.php?error=stmtfailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ssss", $varzybos, $komanda1, $komanda2, $lyga);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../adminpanel/pridetivarzybas.php?error=none");
  exit();
  }
  //Prideda varžybų rezultatus
  function pridetiRezultatus ($conn, $varzybos, $komanda1, $komanda2, $taskai, $lyga) {
    $sql = "INSERT INTO rezultatai (varzybuLaikas, komanda1, komanda2, taskai, lyga) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../adminpanel/pridetirezultatus.php?error=stmtfailed");
      exit();
    }
    mysqli_stmt_bind_param($stmt, "sssss", $varzybos, $komanda1, $komanda2, $taskai, $lyga);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../adminpanel/pridetirezultatus.php?error=none");
    exit();

  // Ištrinti vartotoją
    }
    function sunaikintiVartotoja ($conn, $username) {
      $uidExists = uidExists($conn, $username, $username);

      if ($uidExists === false) {
        header("location: ../adminpanel/sunaikintivartotoja.php?error=wronguser");
        exit();
      }
      $sql = "DELETE FROM users WHERE usersUid='$username'";

      if(mysqli_query($conn, $sql)) {
        header("location: ../adminpanel/sunaikintivartotoja.php?error=none");
        exit();
      }
        else
        header("location: ../adminpanel/sunaikintivartotoja.php?error=stmtfailed");
        exit();
    }
    function emptyInputDeleteuser($username) {
      $result;
      if(empty($username)) {
        $result = true;
      }
      else {
        $result = false;
      }
      return $result;
    }

    function artimiausiosRungtynes($conn) {

      setlocale(LC_ALL, 'lt_LT');
      date_default_timezone_set('Europe/Vilnius');

      $now = date("Y-m-d H:i:s");
      $sql = "SELECT VarzybuLaikas, komanda1, komanda2, lyga FROM tvarkarastis WHERE VarzybuLaikas >= '$now' ORDER BY VarzybuLaikas ASC LIMIT 1";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
                echo $row["VarzybuLaikas"] . "<br>";
                echo $row["komanda1"] . " - " . $row["komanda2"]  . "<br>";
                echo $row["lyga"] . "<br>";
          }
      } else {
          echo "rungtynių šiuo metu nėra! :((";
      }
      $conn->close();
    }
    function pridetiNaujiena($conn, $link, $title, $content, $images, $usersUid) {
      setlocale(LC_ALL, 'lt_LT');
      date_default_timezone_set('Europe/Vilnius');

      $currentDirectory = getcwd();
      $uploadDirectory = "../../images/";
      $fileExtensionsAllowed = ['jpeg','jpg','png'];
      $fileName = $_FILES['foto']['name'];
      $fileSize = $_FILES['foto']['size'];
      $fileTmpName  = $_FILES['foto']['tmp_name'];
      $fileType = $_FILES['foto']['type'];
      $fileExtension = strtolower(end(explode('.',$fileName)));
      $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);
        if (! in_array($fileExtension,$fileExtensionsAllowed)) {
          header("location: ../adminpanel/sukurtinaujiena.php?error=FileNotAllowed");
          exit();
        }
        if ($fileSize > 4000000) {
          header("location: ../adminpanel/sukurtinaujiena.php?error=TooLarge");
          exit();
        }
      $upload = move_uploaded_file($fileTmpName, $uploadPath);


      $laikas = date('Y-m-d H:i:s');
      $sql = "INSERT INTO posts (link, title, content, date, usersUid, image_name) VALUES (?, ?, ?, ?, ?, ?);";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../adminpanel/sukurtinaujiena.php?error=stmtfailed");
        exit();
      }
      mysqli_stmt_bind_param($stmt, "ssssss", $link, $title, $content, $laikas, $usersUid, $fileName);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      header("location: ../adminpanel/sukurtinaujiena.php?error=none");
      exit();
    }

    function pakeistiSlaptazodi ($conn, $username, $pwd, $isadmin) {
      $uidExists = uidExists($conn, $username, $username);

      if ($uidExists === false) {
        header("location: ../adminpanel/pakeistislaptazodi.php?error=wronguser");
        exit();
      }

      $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

      $sql = "UPDATE users SET usersPwd ='$hashedPwd', usersAdmin = '$isadmin' WHERE usersUid='$username'";

      if(mysqli_query($conn, $sql)) {
        header("location: ../adminpanel/pakeistislaptazodi.php?error=none");
        exit();
      }
        else
        header("location: ../adminpanel/pakeistislaptazodi.php?error=stmtfailed");
        exit();
    }

    function redaguotiPosta($conn, $title, $content, $link) {

      $stmt = $conn->prepare("UPDATE posts SET title =?, content =? WHERE link=?");
      $stmt->bind_param('sss', $title, $content, $link);
      $stmt->execute();
      $stmt->close();

      if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../edit.php?edit=$link");
        exit();
      }
        else
        header("location: ../edit.php?edit=$link");
        exit();
    }

    function pridetiKomentara($conn, $commentcontent, $usersUid, $link) {
      setlocale(LC_ALL, 'lt_LT');
      date_default_timezone_set('Europe/Vilnius');
      $lookupID = ("SELECT usersId FROM users WHERE usersUid = '$usersUid'");
      $lookupID2 = ("SELECT postId FROM posts WHERE link = '$link'");
      $result = mysqli_query($conn, $lookupID);
      $row = mysqli_fetch_row($result);
      $locID = $row['0'];

      $result2 = mysqli_query($conn, $lookupID2);
      $row2 = mysqli_fetch_row($result2);
      $locID2 = $row2['0'];

      $laikas = date('Y-m-d H:i:s');
      $sql = "INSERT INTO comments (commentDate, commentContent, usersId, postId) VALUES (?, ?, ?, ?);";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../readmore.php?link=stmtfailed");
        exit();
      }
      mysqli_stmt_bind_param($stmt, "ssss", $laikas, $commentcontent, $locID, $locID2);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      header("location: ../readmore.php?link=$link");
      exit();
    }
    function emptyComment($commentcontent) {
      $result;
      if(empty($commentcontent)) {
        $result = true;
      }
      else {
        $result = false;
      }
      return $result;
    }
    function keistiProfili($conn, $usersPicture, $usersName, $usersUid, $usersEmail, $keiciantisUid) {
      $currentDirectory = getcwd();
      $uploadDirectory = "../../images/profile/";
      $fileExtensionsAllowed = ['jpeg','jpg','png'];
      $fileName = $_FILES['usersPicture']['name'];
      $fileSize = $_FILES['usersPicture']['size'];
      $fileTmpName  = $_FILES['usersPicture']['tmp_name'];
      $fileType = $_FILES['usersPicture']['type'];
      $fileExtension = strtolower(end(explode('.',$fileName)));
      $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);
      if (!isset($usersPicture)) {
        if (!in_array($fileExtension,$fileExtensionsAllowed )) {
          header("location: ../keistiprofili.php?profile=$keiciantisUid&error=FileNotAllowed");
          exit();
        }
      }
        if ($fileSize > 4000000) {
          header("location: ../keistiprofili.php?profile=$keiciantisUid&error=TooLarge");
          exit();
        }
      $upload = move_uploaded_file($fileTmpName, $uploadPath);

      $stmt = $conn->prepare("UPDATE users SET usersName =?, usersUid =?, usersEmail =?, usersPicture =? WHERE usersUid=?");
      $stmt->bind_param('sssss', $usersName, $usersUid, $usersEmail, $fileName, $keiciantisUid);
      $stmt->execute();
      $stmt->close();

      if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../keistiprofili.php?profile=$keiciantisUid&error=none");
        exit();
      }
        else
        header("location: ../keistiprofili.php?profile=$keiciantisUid&error=stmtfailed");
        exit();
    }

 ?>
