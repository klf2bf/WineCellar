<?php 
  include("config.php");
  if (mysqli_connect_errno()) {
    printf("Failed to connect to MySQL: " . mysqli_connect_error()) ;
  }
  $stmt = $db->stmt_init();
  if($stmt->prepare("SELECT winery_name FROM Winery order by winery_name desc")) {
    $stmt->execute();
    $stmt->bind_result($winery_name);


  #$sql="SELECT * FROM ms4 WHERE user = '" . $_SESSION['login_user'] . "' and activity ='" . $_POST['activity'] . "'";
  #$result = mysqli_query($con,$sql);

    #while($row = mysqli_fetch_array($result)) {
    while($stmt->fetch()){
      echo $winery_name ;
      
    }
  }
?>