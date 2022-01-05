<!DOCTYPE html>
<html>

<?php

include_once 'header.php';
include_once 'inc/functions.inc.php';
 ?>

<body class="entire-webpage">
  <div class="banner">
  <img src="banner.jpg" alt="ApvalusKamuolys" width="100%" height="700">
  </div>
  <div class="banner-text">
    <h1 style="font-size:50px">Apvalus Kamuolys</h1>
    <p style="font-size:24px">Naujienos</p>
  </div>
  <hr class= "hrbottom" style="width:100%;text-align:left;margin-left:0">
  <div class ="container">
    <div class = "naujienos">
      <br><br>
      <br>
      <h1>Naujienos</h1>
      <br><br>
      <br>
    </div>
  <section>
    <?php
    include_once 'inc/dbh.inc.php';
    $sql = "SELECT * FROM posts ORDER BY date DESC";
    $query = mysqli_query($conn,$sql);

    ?>

    <?php
    /*$i = 0;*/
    foreach($query as $q){
      /*if ($i++ > 7) break; */
      ?>
    <div class ="postas">
      <div class = "postofoto">
          <a href="readmore.php?link=<?php echo $q['link'] ?> "><img src="images/<?php echo $q['image_name']?>" alt="<?php echo $q['title']?>" width="100%" height="100%"></a>
        </div>
        <div class = "postotekstas">
          <a href="readmore.php?link=<?php echo $q['link'] ?> "><h1><?php echo $q['title'] ?></h1></a>
          <img src="images/humanicon.png" alt="s2" width="16px" height="16px" class = "icon">
          <i><?php echo $q['usersUid'] ?></i>
          &nbsp;
          <img src="images/calendaricon.png" alt="s2" width="16px" height="16px">
          <i><?php echo $q['date'] ?></i>
          <p><?php echo $q['content'] ?></p>
          <div class = "skdaugiaubox">
            <div class = "skdaugiau">
               <a href="readmore.php?link=<?php echo $q['link'] ?>" class="skdaugiaumygtukas">Skaityti daugiau</a>
            </div>
          </div>
        </div>
    </div>
    <?php  }?>
  </section>
  <aside>
        <div class ="asidepostas">
          <br>
            <div class "artimiausiosRungtynes">
                <h2>Artimiausios rungtynės:</h2>
                  <?php
                  artimiausiosRungtynes($conn);
                  ?>
                  <img src="logo.png" class = "logo2" alt="ApvalusKamuolys" width="180" height="180"></img>
            </div>
        </div>
  </aside>
</div>
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
