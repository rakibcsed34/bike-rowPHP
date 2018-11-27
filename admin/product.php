<?php
	session_start();

	if(!$_SESSION['user_id']){
		header('Location: login.php');
	}

	require_once('db.php');
	$db = new DB();

	$selectSql = "SELECT * FROM category";
	$dataCategory = $db->selectData($selectSql);


	$sql = "SELECT * FROM users WHERE user_id = ".$_SESSION['user_id'];
	$row = $db->selectOneData($sql);
	
	if(isset($_POST['btnsave'])){
		//image upload
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		    // $check = getimagesize($_FILES["image"]["tmp_name"]);
		// Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["image"]["size"] > 500000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		/*if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {*/
		    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		// }
		//image upload end


		$sql = "INSERT INTO product 
		(cat_id, product_name, model_number, engine, color, weight, top_speed, mileage, price, image) 
		VALUES (
			'".$_POST['cat_id']."',
			'".$_POST['name']."',
			'".$_POST['mnumber']."',
			'".$_POST['engine']."',
			'".$_POST['color']."',
			'".$_POST['weight']."',
			'".$_POST['tspeed']."',
			'".$_POST['mileage']."',
			'".$_POST['price']."',
			'".$_FILES['image']['name']."')";
			// echo $sql;exit;
		$result = $db->insertData($sql);

		if ($result === TRUE) {
			    $_SESSION['success'] = 1;
			    header("Location: product.php");
				die();
			} else {
			    $_SESSION['success'] = 1;
			    header("Location: product.php");
			}
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>B</b>AP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Bike </b>Admin Panel</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <?php 
    require_once('includes/left-menu.php');
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12">
        	<div class="box box-info">
	            <div class="box-header">
	            	<h3>Add Product</h3>
	            </div>
	            <div class="box-body">
	            	<?php
							// Start the session
							if(isset($_SESSION['success']) && $_SESSION['success'] == 1){echo '<h4 class="text-success text-center">Request completed succefully.</h4>';
							}else if(isset($_SESSION['success']) && $_SESSION['success'] == 2){echo '<h4 class="text-danger text-center">Request failed.</h4>';
							}
							if(isset($_SESSION['success']))
								{unset($_SESSION['success']);}
						?>

	              <form action="" method="POST" enctype="multipart/form-data">
				  	<div class="form-group">
					    <label for="name">Product Name</label>
					    <input name="name" type="text" class="form-control" placeholder="Product Name">
				  	</div>
				  	<div class="form-group">
	                	<label>Category</label>
	                  <select name="cat_id" class="form-control">
	                  	<option value="">Select One</option>
	                  	<?php
	                  		if($dataCategory){
	                  			foreach ($dataCategory as $cvalue) {
	                  	?>
							<option value="<?php echo  $cvalue['cat_id']; ?>"><?php echo  $cvalue['category_name']; ?></option>
	                  	<?php
	                  		}
	                  	}
	                  	?>
	                  	option
	                  </select>
	                </div>
				  	<div class="form-group">
					    <label for="mnumber">Model Number</label>
					    <input name="mnumber" type="text" class="form-control" placeholder="Model Number">
				  	</div>
				  	<div class="form-group">
					    <label for="engine">Engine</label>
					    <input name="engine" type="text" class="form-control" placeholder="Engine">
				  	</div>
				  	<div class="form-group">
					    <label for="color">Color</label>
					    <input name="color" type="text" class="form-control" placeholder="Color">
				  	</div>
				  	<div class="form-group">
					    <label for="weight">Weight</label>
					    <input name="weight" type="text" class="form-control" placeholder="Weight">
				  	</div>
				  	<div class="form-group">
					    <label for="tspeed">Top Speed</label>
					    <input name="tspeed" type="text" class="form-control" placeholder="Top Speed">
				  	</div>
				  	<div class="form-group">
					    <label for="mileage">Mileage</label>
					    <input name="mileage" type="text" class="form-control" placeholder="Mileage">
				  	</div>
				  	<div class="form-group">
					    <label for="price">Price</label>
					    <input name="price" type="text" class="form-control" placeholder="Price">
				  	</div>
				  	Select a file: <input type="file" name="image"><br>

				 	 <button type="submit" name="btnsave" class="btn btn-default">Submit</button>
				</form>
	            </div>
          	</div>
        	<div class="box box-info">
	            <div class="box-header">
	            	<h3>Product List</h3>
	            </div>
	            <div class="box-body">
	            	<div class="table-responsive">	
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>S/N</th>
									<th>Product Name</th>
									<th>Company Name</th>
									<th>Model Number</th>
									<th>Engine</th>
									<th>Color</th>
									<th>Weight</th>
									<th>Speed</th>
									<th>Mileage</th>
									<th>Price</th>
									<th>Image</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php

									$data = $db->selectData("SELECT * FROM product LEFT JOIN category ON category.cat_id = product.cat_id");
									/*echo '<pre>';
print_r($data);exit;*/
									if($data)
									{
										$i=0;

										foreach ($data as $key => $row) 
										{
										$i++;
								?>
										<tr>
											<td><?php echo $i ?></td>
											<td><?php echo $row['product_name']?></td>
											<td><?php echo $row['category_name']?></td>
											<td><?php echo $row['model_number']?></td>
											<td><?php echo $row['engine']?></td>
											<td><?php echo $row['color']?></td>
											<td><?php echo $row['weight']?></td>
											<td><?php echo $row['top_speed']?></td>
											<td><?php echo $row['mileage']?></td>
											<td><?php echo $row['price']?></td>
											<td><img height="90" width="110" src="uploads/<?php echo $row['image']; ?>"></td>
											<td>
											<a href="edit-product.php?product_id=<?php echo $row['product_id']?>" class="btn btn-warning">Edit</a>
											<a href="edit-product.php?product_id=<?php echo $row['product_id']?>" class="btn btn-danger">Delete</a>
										</td>
											
										</tr>
								<?php 
										} 
									}else{
										echo "<tr><td colspan='4' class='text-danger text-center'>No data found!!</td></tr>";
									}
								?>
							</tbody>
						</table>
					</div>
	            </div>
          	</div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  <?php 
    require_once('includes/footer.php');
  ?>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
