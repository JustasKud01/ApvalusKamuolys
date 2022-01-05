<!DOCTYPE html>
<html>
<body>
  <?php
  include_once 'header.php';
  include_once 'inc/functions.inc.php';
   ?>
  <div class="banner">
  <img src="banner.jpg" alt="ApvalusKamuolys" width="100%" height="700">
  </div>
  <div class="banner-text">
    <h1 style="font-size:50px">Apvalus Kamuolys</h1>
    <p style="font-size:24px">Tvarkaraštis</p>
  </div>
  <hr class= "hrbottom" style="width:100%;text-align:left;margin-left:0">
  <div class="container">
    <div class = "naujienos">
      <br><br>
      <br>
      <h1>Tvarkaraštis</h1>
      <br><br>
      <br>
    </div>
  <div class ="container-table">
  <?php
  include_once 'inc/dbh.inc.php';
  $now = date("Y-m-d H:i:s");
  $sql = "SELECT * FROM tvarkarastis WHERE varzybuLaikas >= '$now' ORDER BY varzybuLaikas ASC ";
  $result = $conn->query($sql);
  $conn->close();
  ?>
          <table class = "lent">
              <tr>
                  <th>Ateinančių varžybų data</th>
                  <th colspan="2">Komandos</th>
                  <th>Lyga</th>
              </tr>
              <?php
                  while($rows=$result->fetch_assoc())
                {
               ?>
              <tr>
                  <td><?php echo $rows['VarzybuLaikas'];?></td>
                  <td><?php echo $rows['komanda1'];?></td>
                  <td><?php echo $rows['komanda2'];?></td>
                  <td><?php echo $rows['lyga'];?></td>
              </tr>
              <?php
                  }
               ?>
          </table>

        </div>
      </div>
  <?php
  include_once 'footer.php';
   ?>
</body>
</html>
<script>
setInterval(myTimer, 1000);
function myTimer() {
  const d = new Date();
  document.getElementById("demo").innerHTML = d.toLocaleTimeString('lt-LT');
}
</script>
