<?php
	include("config.php");
	$stmt = $db->stmt_init();
    $winery=$_POST['winery'];
    $wine_name=$_POST['wine_name'];
	$year=$_POST['year'];
    $classification=$_POST['classification'];
    $grape_type_count = $_POST['grape_type_count'];

    $sql = "INSERT INTO Wine (wine_name, year, classification, winery_name) VALUES (?, ?, ?, ?)";
    if($stmt->prepare($sql)) {
        $stmt->bind_param('siss', $wine_name, $year, $classification, $winery);
        $stmt->execute();
        $id=$stmt->insert_id;

        $grapes = $_POST['grapes'];
        // Add grape types
        foreach($grapes as $val) {
            $stmt_3 = $db->stmt_init();
            $sql_3 = "INSERT INTO Type_of_Grape (wine_id, type_of_grape) VALUES ('$id', '$val')";
            if($stmt_3->prepare($sql_3)) {
                $stmt_3->execute();
            } else {
                echo("error: " . htmlspecialchars($stmt_3->error));
            }
        }
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/wineryadmin.php?winery_name=' . $winery);
        exit;

    } else {
        echo("error: " . htmlspecialchars($stmt->error));
    }

    $db->close();
?>