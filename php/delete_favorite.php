<?php

include("config.php");
$stmt = $db->stmt_init();
	$wine_id = $_POST["wine_id"];
    $email =$_SESSION['email'];
    $sql = "DELETE FROM Favorites WHERE email = '$email' AND wine_id='$wine_id'";
    if($stmt->prepare($sql)) {
        $stmt->execute();
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '#favoritesTab');
        exit;
    } else {
        echo("error: " . htmlspecialchars($stmt->error));
    }

    $db->close();
?>