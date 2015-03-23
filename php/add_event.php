<?php
	include("config.php");
	$stmt = $db->stmt_init();
    $winery=$_POST['winery'];
    $event_name=$_POST['event_name'];
    $date=$_POST['date'];
	$start=$_POST['start'];
    $end=$_POST['end'];
    $type=$_POST['type'];
    $description=$_POST['description'];
    if(isset($_POST['public']) && $_POST['public'] == 'on') 
    {
        $public = 1;
    }
    else {
        $public = 0;
    }
    $sql = "INSERT INTO Event (event_name, date, description, type, public, start, end) VALUES ('$event_name', '$date', '$description', '$type', '$public', '$start', '$end')";
    if($stmt->prepare($sql)) {
        $stmt->bind_param('ssssiss', $event_name, $date, $description, $type, $public, $start, $end);
        $stmt->execute();

        // Add connection to winery 
        $stmt_2 = $db->stmt_init();
        $sql_2 = "INSERT INTO Hosts (winery_name, event_name) VALUES ('$winery', '$event_name')";

        if($stmt_2->prepare($sql_2)) {
            $stmt_2->bind_param('ss', $winery, $event_name);
            $stmt_2->execute();
            header('Location: http://' . $_SERVER['HTTP_HOST'] .'/wineryadmin.php?winery_name='. $winery . '#eventTab');
        } else {
            echo("error: " . htmlspecialchars($stmt_2->error));
        }
        exit;
    } else {
        echo("error: " . htmlspecialchars($stmt->error));
    }

    $db->close();
?>