<?php
	include("php/config.php");
	$stmt = $db->stmt_init();
	$email=$_POST['email'];
	$comment=$_POST['comment'];
	$stars=$_POST['stars'];
	$wine_id=$_POST['winery_id'];

    $sql = "INSERT INTO `Rate` (`email`, `wine_id`, `stars`, `comment`) VALUES (\'$email\', \'$wine_id\', \'$stars\', \'$comment\');";
    
    if($stmt->prepare($sql)) {
        $stmt->execute();
        echo("Thank you for your input!");
    } else {
        echo("error: " . htmlspecialchars($stmt->error));
    }

    $db->close();
?>