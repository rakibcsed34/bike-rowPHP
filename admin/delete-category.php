<?php
session_start();
require_once('db.php');
$db = new DB();
$conn = $db->connectDb();
$cat_id = $conn->escape_string($_GET['cat_id']);

$res = $db->selectOneData("SELECT * FROM category where cat_id = $cat_id");

$sql = "DELETE FROM category WHERE cat_id = '$cat_id'";
$row = $db->deleteData($sql);
if ($row === TRUE) {

	if($res['image'] != ''){
		unlink('uploads/'.$res['image']);
	}

	$_SESSION['msg'] = 1;
    header('Location: category.php');
} else {
    $_SESSION['msg'] = 2;
    header('Location: category.php');
}
?>