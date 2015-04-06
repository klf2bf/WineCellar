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
    $sql = "INSERT INTO Event (event_name, winery_name, date, description, type, public, start, end) VALUES (?,?,?,?,?,?,?,?)";
    if($stmt->prepare($sql)) {
        $stmt->bind_param('sssssiss', $event_name, $winery, $date, $description, $type, $public, $start, $end);
        $stmt->execute();

        
        header('Location: http://' . $_SERVER['HTTP_HOST'] .'/wineryadmin.php?winery_name='. $winery . '#eventTab');
        
        exit;
    } else {
        echo("error: " . htmlspecialchars($stmt->error));
    }

    $db->close();
?>