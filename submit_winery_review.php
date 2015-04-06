<?php
	include("php/config.php");
	$stmt = $db->stmt_init();

	$description=$email="";
    $wineryname = $_POST["winery_name"];
    $rating=1;
    $email = $_POST["email"];

    if (empty($_POST["description"])) {
        $descErr = "Description is required. \n";
        echo($descErr);
    } else {
        $description = $_POST["description"];
    }
    
    if (empty($_POST["rating"])) {
        $starsErr = "Rating is required. \n";
        echo($starsErr);
    } else {
        $rating_num = intval($_POST["rating"]);
        if (($rating_num > 5) || ($rating_num < 1)) {
            echo("Rating must be between 1 and 5. \n");
        } else {
            $rating = intval($_POST["rating"]);
        }
        
    }


    if (!(empty($_POST["email"]) || empty($_POST["description"]) || empty($_POST["rating"]))) {
        $sql = "INSERT INTO `Reviews`(`email`, `winery_name`, `description`, `stars`) VALUES (\"$email\",\"$wineryname\",\"$description\", $rating)";
    
        if($stmt->prepare($sql)) {
            $stmt->execute();
        } else {
            echo("error: " . htmlspecialchars($stmt->error));
        }
    }
    
    $db->close();
?>