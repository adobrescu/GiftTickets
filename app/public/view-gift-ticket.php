<?php
//this script acts as a framework "controller"
//the code below shoud stay in a real framework controller method

include_once(__DIR__.'/../config/init.inc.php');

$id=$_GET['id'];

$query='SELECT *
	FROM gift_certificates
	WHERE id=\''.$id.'\'';

$result=$_db->query($query);

if ($result->num_rows>0)
{
	$recordset=$result->fetch_all(MYSQLI_ASSOC);
	header('Content-Type: image/jpeg');
	echo $recordset[0]['img_blob'];
	
}

$result->free();


