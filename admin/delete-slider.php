<?php
session_start();
require_once('db.php');
$db = new DB();
$conn = $db->connectDb();
$slider_id = $conn->escape_string($_GET['slider_id']);

$res = $db->selectOneData("SELECT * FROM slider where slider_id = $slider_id");

$sql = "DELETE FROM slider WHERE slider_id = '$slider_id'";
$row = $db->deleteData($sql);
if ($row === TRUE) {

	if($res['slider_image'] != ''){
		unlink('uploads/slider/'.$res['slider_image']);
	}

	$_SESSION['msg'] = 1;
    header('Location: slider.php');
} else {
    $_SESSION['msg'] = 2;
    header('Location: slider.php');
}
?>