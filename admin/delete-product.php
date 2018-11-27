<?php
session_start();
require_once('db.php');
$db = new DB();
$conn = $db->connectDb();
$id = $conn->escape_string($_GET['id']);

$res = $db->selectOneData("SELECT * FROM product where id = $id");

$sql = "DELETE FROM product WHERE id = '$id'";
$row = $db->deleteData($sql);
if ($row === TRUE) {

	if($res['image'] != ''){
		unlink('uploads/'.$res['image']);
	}

	$_SESSION['msg'] = 1;
    header('Location: product.php');
} else {
    $_SESSION['msg'] = 2;
    header('Location: product.php');
}
?>