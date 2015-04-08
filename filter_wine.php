<?php
	include("php/config.php");
	$stmt = $db->stmt_init();
	$winery_name = $_SESSION['winery_name'];
    $type = $_POST["class"];

    if ($type == "All") {
        $sql = "SELECT wine_id, wine_name, year, classification, price, description FROM Wine WHERE winery_name='$winery_name'";
    } else {
        $sql = "SELECT wine_id, wine_name, year, classification, price, description FROM Wine WHERE winery_name='$winery_name' AND classification='$type'";
    }

    
    
    if($stmt->prepare($sql)) {
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($wine_id, $wine_name, $year, $classification, $price, $description);
        while($stmt->fetch()){
            echo "<a href='#' class='list-group-item' data-toggle='collapse' data-target='#wine_" . $wine_id . "' data-parent='#wines'>" . $wine_name . " (" . $year . ") " . $classification . "</a>";
            echo "<div id='wine_" . $wine_id . "' class='sublinks collapse'>
                        <a class='list-group-item small'><ul>
                        <li><u>Price:</u>" . $price . "</li>
                        <li><u>Description:</u> " . $description . "</li>
                        <li><u>Reviews:</u><ul>";
            $stmt_2 = $db->stmt_init();
            $sql_2 = "SELECT email, stars, comment, timestamp FROM Rate WHERE wine_id='$wine_id'";
            if($stmt_2->prepare($sql_2)) {
                $stmt_2->execute();
                $stmt_2->store_result();
                $stmt_2->bind_result($commenter_email, $stars, $comment, $timestamp);
                $num = $stmt_2->num_rows();
                if($num == 0){
                    echo "&nbsp;&nbsp;No reviews";
                }
                while($stmt_2->fetch()){
                    echo "<li>";
                    for ($x = 0; $x < $stars; $x++)
                    {
                        echo "<span class='glyphicon glyphicon-star' aria-hidden='true'></span>";
                    }
                    for ($x = $stars; $x < 5; $x++)
                    {
                        echo "<span class='glyphicon glyphicon-star-empty' aria-hidden='true'></span>";
                    }
                    echo " by " . $commenter_email . " on " . $timestamp;
                    echo "</br><p>" . $comment . "</p></li>";
                }  


            } else {
                echo("error: " . htmlspecialchars($stmt_2->error));
            }
            echo "</ul></li></ul></a>
                    </div>";
        }
    }

    $db->close();
?>