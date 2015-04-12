<?php
	include("php/config.php");
	$stmt = $db->stmt_init();
    $stmt_4 = $db->stmt_init();
	$winery_name = $_SESSION['winery_name'];
    $type = $_POST["class"];
    $email = $_SESSION['email'];
    if ($type == "All") {
        $sql = "SELECT wine_id, wine_name, year, classification, price, description FROM Wine WHERE winery_name='$winery_name'";
    } else {
        $sql = "SELECT wine_id, wine_name, year, classification, price, description FROM Wine WHERE winery_name='$winery_name' AND classification='$type'";
    }

    $sql_4 = "SELECT wine_id FROM Favorites WHERE email='$email'";
    
    if($stmt_4->prepare($sql_4)){
        $stmt_4->execute();
        $stmt_4->store_result();
        $stmt_4->bind_result($favorite_id);
        $i = 0;
        while($stmt_4->fetch()){
            $favorites[$i] = $favorite_id;
            $i++;
        }
    }
    if($stmt->prepare($sql)) {
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($wine_id, $wine_name, $year, $classification, $price, $description);
        while($stmt->fetch()){
            if (in_array($wine_id, $favorites)) {
                $form = " <span class='glyphicon glyphicon-heart' aria-hidden='true'></span>";
                $form_2 = "<form action='php/remove_favorite.php' method='post'><input type='hidden' name='wine_id' value='" . $wine_id . "'/><button class='btn btn-primary' type='submit'>Unfavorite?</button></form>";
            } else {
                $form = "";
                $form_2 = "<form action='php/add_favorite.php' method='post'><input type='hidden' name='wine_id' value='" . $wine_id . "'/><button class='btn btn-primary' type='submit'>Favorite?</button></form>";
            }
            echo "<a href='#' class='list-group-item' data-toggle='collapse' data-target='#wine_" . $wine_id . "' data-parent='#wines'>" . $wine_name . " (" . $year . ") " . $classification . $form . " </a>";
            echo "<div id='wine_" . $wine_id . "' class='sublinks collapse'>
                        <a class='list-group-item small'><ul>
                        <li>" . $form_2 . "</li>
                        <li><u>Price: </u>" . $price . "</li>
                        <li><u>Description: </u> " . $description . "</li>";
                        

            $stmt_3 = $db->stmt_init();
            $sql_3 = "SELECT type_of_grape FROM Type_of_Grape WHERE wine_id=$wine_id";
            if($stmt_3->prepare($sql_3)) {
                $stmt_3->execute();
                $stmt_3->store_result();
                $stmt_3->bind_result($type_of_grape);
                echo "<li><u>Type of Grapes: </u>";
                echo "<ul>";
                while($stmt_3->fetch()) {
                    echo "<li>" . $type_of_grape . "</li>";
                }
                echo "</ul>";
            } else {
                echo("error: " . htmlspecialchars($stmt_2->error));
            }

            echo "<li><u>Reviews: </u><ul>";

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