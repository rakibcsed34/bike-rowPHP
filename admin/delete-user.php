<?php
	session_start();
	require_once('db.php');
	$db = new DB();
	$conn = $db->connectDb();
	$id = $conn->escape_string($_GET['user_id']);

	$res = $db->selectOneData("SELECT * FROM users where user_id = $id");

	$sql = "DELETE FROM users WHERE user_id = '$id'";
	$row = $db->deleteData($sql);
	if ($row === TRUE) {
		echo 1;
	} else {
	    echo 0;
	}
?>