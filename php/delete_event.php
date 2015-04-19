<?php
	include("config.php");
	$stmt = $db->stmt_init();
    $event_name=$_POST['event_name'];
    $winery_name=$_POST['winery_name'];
    
    $sql = "DELETE FROM Event WHERE event_name = '$event_name' and winery_name = '$winery_name'";
    if($stmt->prepare($sql)) {
        $stmt->execute();
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '#eventTab');
        exit;
    } else {
        echo("error: " . htmlspecialchars($stmt->error));
    }

    $db->close();
?>