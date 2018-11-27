<?php
	require_once('db.php');
	$db = new DB();

	$sql = "SELECT category_name FROM category WHERE category_name = '".$_POST['val']."'";
	$res = $db->selectOneData($sql);
	if($res){
		echo 1;
	}else{
		echo 0;
	}
?>