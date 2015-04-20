<?php

include("config.php");
$stmt = $db->stmt_init();
	$email = $_POST["email"];
    $time_stamp = $_POST["time_stamp"];
    $sql = "DELETE FROM Reviews WHERE email = '$email' AND timestamp = '$time_stamp'";
    if($stmt->prepare($sql)) {
        $stmt->execute();
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '#reviewsTab');
        exit;
    } else {
        echo("error: " . htmlspecialchars($stmt->error));
    }

    $db->close();
?>