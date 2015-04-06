<?php
	include("config.php");
	$stmt = $db->stmt_init();
    $winery=$_POST['winery'];
    $day=$_POST['day'];
	$open=$_POST['open'];
    $close=$_POST['close'];
    
    $sql = "UPDATE Winery_Hours SET open = '$open', close = '$close' WHERE winery_name = '$winery' AND day_of_week = '$day'";
    if($stmt->prepare($sql)) {
        $stmt->execute();
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '#informationTab');
        exit;
    } else {
        echo("error: " . htmlspecialchars($stmt->error));
    }

    $db->close();
?>