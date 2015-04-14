<?php
	include("config.php");
	$stmt = $db->stmt_init();
    $wine_id = (int)$_POST['wine_id'];
    $email = $_SESSION['email'];

    $sql = "INSERT INTO Favorites (email, wine_id) VALUES (?, ?)";
    if($stmt->prepare($sql)) {
        $stmt->bind_param('si', $email, $wine_id);
        $stmt->execute();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;

    } else {
        echo("error: " . htmlspecialchars($stmt->error));
    }

    $db->close();
?>