<?php
	include("config.php");
	$stmt = $db->stmt_init();
    $wine_id=$_POST['wine_id'];
    
    $sql = "DELETE FROM Wine WHERE wine_id = '$wine_id'";
    if($stmt->prepare($sql)) {
        $stmt->execute();
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '#wineTab');
        exit;
    } else {
        echo("error: " . htmlspecialchars($stmt->error));
    }

    $db->close();
?>