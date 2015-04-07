<?php
	include("php/config.php");
	$stmt = $db->stmt_init();
	$email=$_POST['email'];

	$comment=$_POST['comment'];
	$stars=$_POST['stars'];
	$wine_id=$_POST['wine_id'];

    if (empty($_POST["comment"])) {
        $descErr = "Comment is required. \n";
        echo($descErr);
    } else {
        $comment = $_POST["comment"];
    }
    
    if (empty($_POST["stars"])) {
        $starsErr = "Star rating is required. \n";
        echo($starsErr);
    } else {
        $rating_num = intval($_POST["stars"]);
        if (($rating_num > 5) || ($rating_num < 1)) {
            echo("Rating must be between 1 and 5. \n");
        } else {
            $rating = intval($_POST["stars"]);
        }
        
    }

    $sql = "INSERT INTO Rate VALUES ('$email', '$wine_id', '$stars', '$comment', DEFAULT)";
    
    if($stmt->prepare($sql)) {
        $stmt->execute();
    } else {
        echo("error: " . htmlspecialchars($stmt->error));
    }

    $db->close();
?>