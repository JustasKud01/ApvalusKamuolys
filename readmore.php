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
    $link = $_GET['link'];
    $sql = "SELECT * FROM posts WHERE link = '$link' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        ?>
        <section>
        <div class ="readmore">
          <?php
          if(isset($_SESSION["useruid"])) {
            if($_SESSION['usersAdmin'] == 'Yes') {
              ?>
              <div class = "skdaugiaubox">
                <div class = "skdaugiau">
                   <a href="edit.php?edit=<?php echo $row["link"];?>" class="skdaugiaumygtukas">Redaguoti naujieną</a>
                </div>
              </div>
            <?php }} ?>
          <div class = "readmorefoto">
              <img src="images/<?php echo $row["image_name"]; ?>" alt="s" width="750px" height="440px">
            </div>
            <div class = "readmoretekstas">
              <h1><?php echo $row["title"]; ?></h1>
              <div class= "postinfo">
              <img src="images/humanicon.png" alt="s2" width="16px" height="16px" class = "icon">
              <i><?php echo $row["usersUid"]; ?></i>
              &nbsp;
              <img src="images/calendaricon.png" alt="s2" width="16px" height="16px">
              <i><?php echo $row["date"]; ?></i>
              <p><?php echo nl2br($row["content"]); ?></p>
                <?php
                  } }
                ?>
                </div>
             </div>
            </div>
            <?php
            $link = $_GET['link'];
            $sql = "SELECT comments.commentDate, comments.commentContent, posts.link, users.usersUid, users.usersPicture
            FROM comments INNER JOIN posts ON comments.postId = posts.postId INNER JOIN users ON comments.usersId = users.usersId
            WHERE posts.link = '$link' ORDER BY comments.commentDate DESC; ";
            $query = mysqli_query($conn,$sql);
            ?>
                <?php foreach($query as $q){
                  ?>
                  <div class = "komentaras">
                    <div class = "komentarasfoto">
                        <a href="profilis.php?profile=<?php echo $q['usersUid']; ?>"><img src="/images/profile/<?php echo $q['usersPicture']; ?>" class = "userpicture" alt="profile" width="64" height="64"><a>
                          <a href="profilis.php?profile=<?php echo $q['usersUid']; ?>"><span class="komentarasvardas"><?php echo $q['usersUid']; ?></span></a>
                    </div>
                    <div class = "komentarastekstas">
                      <p class = "komentarasdata" ><?php echo $q['commentDate']; ?></p>
                      <p><?php echo $q['commentContent']; ?></p>
                      </div>
                    </div>
                    <?php
                  }
                  ?>
              <?php
              if(isset($_SESSION["useruid"])) {
                ?>
                <div class = "komentaras">
                  <div class = "komentarasfoto">
                      <a href="profilis.php?profile=<?php echo $_SESSION['useruid'] ?>"><img src="/images/profile/<?php echo $_SESSION['usersPicture'] ?>" class = "userpicture" alt="profile" width="64" height="64"><a>
                        <a href="profilis.php?profile=<?php echo $_SESSION['useruid'] ?>"><span class="komentarasvardas"><?php echo $_SESSION['useruid'] ?></span></a>
                  </div>
                    <form action="../inc/pridetikomentara.inc.php" enctype="multipart/form-data" method="post">
                  <div class = "komentarastekstas">
                    <h3>Rašykite komentarą čia!</h3>
                    <textarea type="text" placeholder="Komentaras" required name="title" id ="title"></textarea>
                    <input type="hidden" name="link" value="<?php echo $_GET['link']; ?>">
                    <button class = "loginbutton" name = "submit" >Paskelbti komentarą</button>
                    </div>
                  </div>
                <?php
                }
                 ?>
        </div>
      </section>
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
