<?php
	session_start();

	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=winery_reviews.csv;');


	$output = fopen('php://output', 'w');
	fputcsv($output, array('Email', 'Winery Name', 'Timestamp', 'Description', 'Stars'));

	$host = 'stardock.cs.virginia.edu';
	$db = 'cs4750klf2bf';
	$user = 'cs4750klf2bf';
	$pass = 'wine';
	$winery_name = $_SESSION['admin_winery_name'];

	mysql_connect($host, $user, $pass);
	mysql_select_db($db);

	$query = "Select * From Reviews Where winery_name='$winery_name'";
	$rows = mysql_query($query);
	
	while($row = mysql_fetch_assoc($rows)) {
		fputcsv($output, $row);
	}
	
?>