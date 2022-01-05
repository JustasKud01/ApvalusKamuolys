
<!DOCTYPE html>
<html>
<?php
include_once 'header.php';
include_once 'inc/functions.inc.php';
 ?>
<body>
  <div class="banner">
  <img src="banner.jpg" alt="ApvalusKamuolys" width="100%" height="700">
  </div>
  <div class="banner-text">
    <h1 style="font-size:50px">Apvalus Kamuolys</h1>
    <p style="font-size:24px">Naujienos</p>
  </div>
  <hr class= "hrbottom" style="width:100%;text-align:left;margin-left:0">
    </div>
    <?php
    include_once 'inc/dbh.inc.php';
    $link = $_GET['edit'];
    $sql = "SELECT * FROM posts WHERE link = '$link' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        ?>
        <section>
        <form action="../inc/editpost.inc.php?edit=<?php echo ($row["link"]); ?>" enctype="multipart/form-data" method="post">
        <div class ="readmore">
          <div class = "skdaugiaubox">
            <div class = "skdaugiau">
               <a href="readmore.php?link=<?php echo $row["link"];?>" class="skdaugiaumygtukas">Grįžti atgal į naujieną</a>

            </div>
          </div>
          <div class = "readmorefoto">
              <img src="images/<?php echo $row["image_name"]; ?>" alt="s" width="750px" height="440px">
            </div>
            <div class = "readmoretekstas">
              <h1><textarea type="text" name="title" id ="title"><?php echo $row["title"]; ?></textarea></h1>
              <div class= "postinfo">
              <img src="images/humanicon.png" alt="s2" width="16px" height="16px" class = "icon">
              <i><?php echo $row["usersUid"]; ?></i>
              &nbsp;
              <img src="images/calendaricon.png" alt="s2" width="16px" height="16px">
              <i><?php echo $row["date"]; ?></i>
              <p><textarea  type="text" name="content" id ="content"><?php echo ($row["content"]); ?> </textarea></p>
            </div>
              <button class = "loginbutton" name="submit" type="submit">Baigti redaguoti</button>
            </div>
        </div>
      </section>
        <?php
      }
    } else {
    }
    ?>
  <aside>
    <div class ="asidepostas">
        <div class "artimiausiosRungtynes">
            <h2>Artimiausios rungtynės:</h2>
              <?php
              artimiausiosRungtynes($conn);
              ?>
              <img src="logo.png" class = "logo2" alt="ApvalusKamuolys" width="180" height="180"></img>
        </div>
    </div>
  </aside>
</body>


<?php
include_once 'footer.php';
 ?>

</html>

<script>
setInterval(myTimer, 1000);

function myTimer() {
  const d = new Date();
  document.getElementById("demo").innerHTML = d.toLocaleTimeString('lt-LT');
}
</script>
