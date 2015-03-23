<?php
	include("php/config.php");
	$stmt = $db->stmt_init();
	$email=$_POST['email'];
	$description=$_POST['description'];
	$rating=$_POST['rating'];
	$wineryname=$_POST['winery_name'];

    $sql = "INSERT INTO `Reviews`(`email`, `winery_name`, `description`, `rating`) VALUES (\"$email\",\"$wineryname\",\"$description\", $rating)";
    
    if($stmt->prepare($sql)) {
        $stmt->execute();
        echo("Thank you for your input!");
    } else {
        echo("error: " . htmlspecialchars($stmt->error));
    }

    $db->close();
?>