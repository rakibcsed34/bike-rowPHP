<?php
	// Start the session
	session_start();
	require_once('db.php');
	$db = new DB();

	if(isset($_POST['btnsave'])){

		if($_FILES['image']['name'] != ''){
			//image upload
			$target_dir = "uploads/";
			$file_name = time(). basename($_FILES["image"]["name"]);
			$target_file = $target_dir . $file_name;
			// echo $target_file;exit;
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			// Check if image file is a actual image or fake image
			    // $check = getimagesize($_FILES["image"]["tmp_name"]);
			// Check if file already exists
			/*if (file_exists($target_file)) {
			    echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}*/
			// Check file size
			if ($_FILES["image"]["size"] > 500000) {
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
			    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

			    	$row = $db->selectOneData("SELECT * FROM product where product_id = ".$_POST['product_id']);


					if($row['image'] != ''){
						unlink('uploads/'.$row['image']);
					}

					$rowResult = $db->updateData("UPDATE product SET 
						product_name ='".$_POST['name']."',
						cat_id ='".$_POST['cat_id']."',
						model_number ='".$_POST['mnumber']."',
						engine ='".$_POST['engine']."',
						color ='".$_POST['color']."',
						weight ='".$_POST['weight']."',
						top_speed ='".$_POST['tspeed']."',
						mileage ='".$_POST['mileage']."',
						price ='".$_POST['price']."',
						image ='".$file_name."'
						WHERE product_id = ".$_POST['product_id']);

					if ($rowResult === TRUE) {
						    $_SESSION['success'] = 1;
						    header("Location: product.php");
							die();
						} else {
							$_SESSION['success'] = 2;
						    header("Location: product.php");
						}
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
			//image upload end
		}else {
			$image_old = $_POST['image_old'];
			$rowResult = $db->updateData("UPDATE product SET 
			product_name ='".$_POST['name']."',
			cat_id ='".$_POST['cat_id']."',
			model_number ='".$_POST['mnumber']."',
			engine ='".$_POST['engine']."',
			color ='".$_POST['color']."',
			weight ='".$_POST['weight']."',
			top_speed ='".$_POST['tspeed']."',
			mileage ='".$_POST['mileage']."',
			price ='".$_POST['price']."',
			image ='".$image_old."'
			WHERE product_id = ".$_POST['product_id']);

			/*echo "UPDATE product SET 
			product_name ='".$_POST['name']."',
			cat_id ='".$_POST['name']."',
			model_number ='".$_POST['mnumber']."',
			engine ='".$_POST['engine']."',
			color ='".$_POST['color']."',
			weight ='".$_POST['weight']."',
			top_speed ='".$_POST['tspeed']."',
			mileage ='".$_POST['mileage']."',
			price ='".$_POST['price']."',
			image ='".$image_old."'
			WHERE product_id = ".$_POST['product_id'];exit;*/

		if ($rowResult === TRUE) {
			    $_SESSION['success'] = 1;
			    header("Location: product.php");
				die();
			} else {
				$_SESSION['success'] = 2;
			    header("Location: product.php");
			}
		}

		
	}
?>