<?php
	include("config.php");
	$stmt = $db->stmt_init();
    $winery=$_POST['winery'];
    $day=$_POST['day'];
	$open=$_POST['open'];
    $close=$_POST['close'];
    $sql = "INSERT INTO Winery_Hours (winery_name, day_of_week, open, close) VALUES ('$winery', '$day', '$open', '$close')";
    if($stmt->prepare($sql)) {
        $stmt->execute();
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '#informationTab');
        exit;
    } else {
        echo("error: " . htmlspecialchars($stmt->error));
    }

    $db->close();
?>