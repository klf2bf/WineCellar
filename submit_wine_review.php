<?php
	include("php/config.php");
	$stmt = $db->stmt_init();
	$email=$_POST['email'];
	$comment=$_POST['comment'];
	$stars=$_POST['stars'];
	$wine_id=$_POST['wine_id'];

    $sql = "INSERT INTO Rate VALUES ('$email', '$wine_id', '$stars', '$comment', DEFAULT)";
    
    if($stmt->prepare($sql)) {
        $stmt->execute();
        echo("Thank you for your input!");
    } else {
        echo("error: " . htmlspecialchars($stmt->error));
    }

    $db->close();
?>