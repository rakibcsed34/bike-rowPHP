<?php
	// Start the session
	session_start();
	require_once('db.php');
	$db = new DB();

	if(isset($_POST['btnsave'])){

		if($_FILES['slider_image']['name'] != ''){
			//image upload
			$target_dir = "uploads/slider/";
			$file_name = basename($_FILES["slider_image"]["name"]);
			$target_file = $target_dir . $file_name;
			// echo $target_file;exit;
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// Check file size
			if ($_FILES["slider_image"]["size"] > 500000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif"&& $imageFileType != "JPG" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["slider_image"]["tmp_name"], $target_file)) {

			    	$row = $db->selectOneData("SELECT * FROM slider where slider_id = ".$_POST['slider_id']);


					if($row['slider_image'] != ''){
						unlink('uploads/slider/'.$row['slider_image']);
					}

					$rowResult = $db->updateData("UPDATE slider SET 
						slider_title ='".$_POST['slider_title']."',
						slider_image ='".$file_name."'
						WHERE slider_id = ".$_POST['slider_id']);

					if ($rowResult === TRUE) {
						    $_SESSION['success'] = 1;
						    header("Location: slider.php");
							die();
						} else {
							$_SESSION['success'] = 2;
						    header("Location: slider.php");
						}
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
			//image upload end
		}else {
			$image_old = $_POST['slider_image_old'];
			$rowResult = $db->updateData("UPDATE slider SET 
			slider_title ='".$_POST['slider_title']."',
			slider_image ='".$image_old."'
			WHERE slider_id = ".$_POST['slider_id']);

		if ($rowResult === TRUE) {
			    $_SESSION['success'] = 1;
			    header("Location: slider.php");
				die();
			} else {
				$_SESSION['success'] = 2;
			    header("Location: slider.php");
			}
		}

		
	}
?>