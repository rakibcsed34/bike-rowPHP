<?php 
  session_start();

  require_once('db.php');
  $db = new DB();

  if(!$_SESSION['user_id']){
    header('Location: index.php');
  }


  if(isset($_POST['btn'])){
    $insertSql = "INSERT INTO category (category_name) VALUES ('".$_POST['category_name']."')";

    $db->insertData($insertSql);
  }

  
  $sql = "SELECT * FROM users WHERE user_id = ".$_SESSION['user_id'];
  $row = $db->selectOneData($sql);

  if(isset($_POST['btnsave'])){


//image upload
    $target_dir = "uploads/slider/";
    $target_file = $target_dir . basename($_FILES["slider_image"]["name"]);
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
    if ($_FILES["slider_image"]["size"] > 500000) {
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
        if (move_uploaded_file($_FILES["slider_image"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["slider_image"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    // }
    //image upload end


        $sql = "INSERT INTO slider 
    (slider_title, slider_image) 
    VALUES (
      '".$_POST['slider_title']."',
      '".$_FILES['slider_image']['name']."')";
      // echo $sql;exit;
    $result = $db->insertData($sql);

    if ($result === TRUE) {
          $_SESSION['success'] = 1;
          header("Location: slider.php");
        die();
      } else {
          $_SESSION['success'] = 1;
          header("Location: slider.php");
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
        <div class="col-lg-12 col-xs-6">
          <div class="box box-info">
              <div class="box-header">
                <h3>Add Slider</h3>
              </div>
              <div class="box-body">
                <?php
                  // Start the session
                  if(isset($_SESSION['success']) && $_SESSION['success'] == 1){echo '<h4 class="text-success text-center">Request completed succefully.</h4>';
                  }else if(isset($_SESSION['success']) && $_SESSION['success'] == 2){echo '<h4 class="text-danger text-center">Request failed.</h4>';
                  }
                  unset($_SESSION['success']);
                ?>
                <form action="" method="post" class="col-lg-6" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Slider Title</label>
                    <input type="text" class="form-control" name="slider_title" placeholder="Slider Title">
                  </div>

                  <div class="form-group">
                    <label>Slider Image</label>
                    <input type="file" class="form-control" name="slider_image">
                  </div>

                  <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="btnsave" value="Save">
                  </div>
                </form>
              </div>
            </div>
            <div class="box box-info">
              <div class="box-header">
                <h3>Slider List</h3>
              </div>
              <div class="box-body">
                <div class="table-responsive"> 
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>S/N</th>
                        <th>Slider Title</th>
                        <th>Slider Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                        $data = $db->selectData("SELECT * FROM slider ORDER BY slider_id DESC");

                        if($data)
                        {
                          $i=0;

                          foreach ($data as $key => $row) 
                          {
                          $i++;
                      ?>
                          <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row['slider_title']?></td>
                            <td><?php echo $row['slider_image']?></td>
                            <td>
                            <a href="edit-slider.php?slider_id=<?php echo $row['slider_id']?>" class="btn btn-warning">Edit</a>
                          </td>
                            <td>
                            <a href="delete-slider.php?slider_id=<?php echo $row['slider_id']?>" class="btn btn-danger">Delete</a>
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
