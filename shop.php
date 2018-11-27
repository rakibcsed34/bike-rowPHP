<!DOCTYPE html>
<html lang="zxx"><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
      <title>Motor Bike Store</title>
      <!--meta tags -->
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="keywords" content="" />
      <script>
         addEventListener("load", function () {
         	setTimeout(hideURLbar, 0);
         }, false);
         
         function hideURLbar() {
         	window.scrollTo(0, 1);
         }
      </script>
      <!--//meta tags ends here-->
      <!--booststrap-->
      <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
      <!--//booststrap end-->
      <!-- font-awesome icons -->
      <link href="assets/css/fontawesome-all.min.css" rel="stylesheet" type="text/css" media="all">
      <!-- //font-awesome icons -->
      <!-- For Clients slider -->
      <link rel="stylesheet" href="assets/css/flexslider.css" type="text/css" media="all" />
      <!--flexs slider-->
      <link href="assets/css/JiSlider.html" rel="stylesheet">
      <!--Shoping cart-->
      <link rel="stylesheet" href="assets/css/shop.css" type="text/css" />
      <!--//Shoping cart-->
      <!--stylesheets-->
      <link href="assets/css/style.css" rel='stylesheet' type='text/css' media="all">
      <!--//stylesheets-->
      <link href="http://fonts.googleapis.com/css?family=Sunflower:500,700" rel="stylesheet">
      <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
   </head>
   <body>
<script src='assets/js/jquery-2.2.3.min.js'></script>
<!-- <script src="../../../../../../../m.servedby-buysellads.com/monetization.js" type="text/javascript"></script> -->
<body>
      <div class="header-outs" id="home">
         <?php require_once('nav.php'); ?>
      </div>
      <?php 
         require_once('admin/db.php'); 
         $db = new DB();

         $selectSql = "SELECT * FROM product p LEFT JOIN category c ON c.cat_id = p.cat_id WHERE p.product_id = ".$_GET['product_id'];
         $dataProduct = $db->selectOneData($selectSql);
         
      ?>

            <!--new Arrivals -->
            <section class="blog py-lg-4 py-md-3 py-sm-3 py-3" style="
    padding-top: 150px !important;
">
               <div class="container py-lg-5 py-md-4 py-sm-4 py-3">
                  <h3 class="title clr text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">Product Details</h3>
                  <div class="col-md-12">
          <div class="card flex-md-row mb-2 shadow-sm h-md-250">
            <div class="card-body d-flex flex-column align-items-start bg-warning">
              <strong class="d-inline-block mb-2 text-primary"><?php echo $dataProduct['category_name'] ?></strong>
              <h3 class="mb-0">
                <a class="text-dark" href="javascript:void(0)"><?php echo $dataProduct['product_name'] ?></a>
              </h3>
              <p class="card-text mb-auto">Year:<span class="text-success"><?php echo $dataProduct['model_number'] ?></span></p>
              <p class="card-text mb-auto">Engine:<span class="text-success"><?php echo $dataProduct['engine'] ?></span></p>
              <p class="card-text mb-auto">Color:<span class="text-success"><?php echo $dataProduct['color'] ?></span></p>
              <p class="card-text mb-auto">Weight:<span class="text-success"><?php echo $dataProduct['weight'] ?></span></p>
              <p class="card-text mb-auto">Speed:<span class="text-success"><?php echo $dataProduct['top_speed'] ?></span></p>
              <p class="card-text mb-auto">Mileage:<span class="text-success"><?php echo $dataProduct['mileage'] ?></span></p>
              <p class="card-text mb-auto">Price:<span class="text-success"><?php echo $dataProduct['price'] ?></span></p>
            </div>
            <img class="card-img-right flex-auto d-none d-lg-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail" style="width: 400px; height: 250px;" src="<?php echo 'admin/uploads/'.$dataProduct['image'] ?>" data-holder-rendered="true">
          </div>
          <a href="index.php">Back</a>
        </div>
               </div>
            </section>
            <!-- //about -->
      <!-- footer  -->
      <?php require_once('footer.php'); ?>
      <!-- //footer-->
      <!--js working-->
      <script src="assets/js/jquery-2.2.3.min.js"></script>
      <!--//js working-->
      <!-- cart-js -->
      <script src="assets/js/minicart.js"></script>
      <!-- //cart-js -->
      <!--responsiveslides banner-->
      <script src="assets/js/responsiveslides.min.js"></script>
      <script>
         // You can also use "$(window).load(function() {"
         $(function () {
         	// Slideshow 4
         	$("#slider4").responsiveSlides({
         		auto: true,
         		pager:false,
         		nav:true ,
         		speed: 900,
         		namespace: "callbacks",
         		before: function () {
         			$('.events').append("<li>before event fired.</li>");
         		},
         		after: function () {
         			$('.events').append("<li>after event fired.</li>");
         		}
         	});
         
         });
      </script>
      <!--// responsiveslides banner-->	 
      <!--slider flexisel -->
      <script src="assets/js/jquery.flexisel.js"></script>
      <script>
         $(window).load(function() {
         	$("#flexiselDemo1").flexisel({
         		visibleItems: 3,
         		animationSpeed: 3000,
         		autoPlay:true,
         		autoPlaySpeed: 2000,    		
         		pauseOnHover: true,
         		enableResponsiveBreakpoints: true,
         		responsiveBreakpoints: { 
         			portrait: { 
         				changePoint:480,
         				visibleItems: 1
         			}, 
         			landscape: { 
         				changePoint:640,
         				visibleItems:2
         			},
         			tablet: { 
         				changePoint:768,
         				visibleItems: 2
         			}
         		}
         	});
         	
         });
      </script>
      <!-- //slider flexisel -->
      <!-- start-smoth-scrolling -->
      <script src="assets/js/move-top.js"></script>
      <script src="assets/js/easing.js"></script>
      <script>
         jQuery(document).ready(function ($) {
         	$(".scroll").click(function (event) {
         		event.preventDefault();
         		$('html,body').animate({
         			scrollTop: $(this.hash).offset().top
         		}, 900);
         	});
         });
      </script>
      <!-- start-smoth-scrolling -->
      <!-- here stars scrolling icon -->
      <script>
         $(document).ready(function () {
         
         	var defaults = {
         		containerID: 'toTop', // fading element id
         		containerHoverID: 'toTopHover', // fading element hover id
         		scrollSpeed: 1200,
         		easingType: 'linear'
         	};
         	$().UItoTop({
         		easingType: 'easeOutQuart'
         	});
         
         });
      </script>
      <!-- //here ends scrolling icon -->
      <!--bootstrap working-->
      <script src="assets/js/bootstrap.min.js"></script>
      <!-- //bootstrap working-->
   </body>

<!-- Mirrored from p.w3layouts.com/demos_new/template_demo/01-10-2018/toys_shop-demo_Free/695002674/web/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 03 Oct 2018 08:29:59 GMT -->
</html>