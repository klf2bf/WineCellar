<?php
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=winery_reviews.csv;');


	$output = fopen('php://output', 'w');
	fputcsv($output, array('Email', 'Winery Name', 'Timestamp', 'Description', 'Stars'));

	$host = 'stardock.cs.virginia.edu';
	$db = 'cs4750klf2bf';
	$user = 'cs4750klf2bf';
	$pass = 'wine';

	mysql_connect($host, $user, $pass);
	mysql_select_db($db);
	$rows = mysql_query('Select * From Reviews');
	
	while($row = mysql_fetch_assoc($rows)) {
		fputcsv($output, $row);
	}
?>