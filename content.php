<?php 
   require_once('admin/db.php'); 
   $db = new DB();

   $selectSql = "SELECT * FROM product ORDER BY product_id DESC";
   $dataProduct = $db->selectData($selectSql);
   
?>
<!--about -->
      <section class="about py-lg-4 py-md-3 py-sm-3 py-3" id="about">
	  <!---728x90--->
      </section>
      <!-- //about -->
      <!--new Arrivals -->
      <section class="blog py-lg-4 py-md-3 py-sm-3 py-3">
         <div class="container py-lg-5 py-md-4 py-sm-4 py-3">
            <h3 class="title clr text-center mb-lg-5 mb-md-4 mb-sm-4 mb-3">New Arrivals</h3>
            <div class="slid-img">
               <ul id="flexiselDemo1">
                  <?php
                  $i = 0;
                  foreach ($dataProduct as $key => $value) {
                     $i++;
                  ?>
                  <li>
                     <div class="agileinfo_port_grid">
                        <img height="150" width="200" src="<?php echo 'admin/uploads/'.$value['image']; ?>" alt=" " class="" />
                        <div class="banner-right-icon">
                           <h4 class="pt-3"><?php echo $value['product_name'] ?></h4>
                        </div>
                        <div class="outs_more-buttn">
                           <a href="shop.php?product_id=<?php echo $value['product_id'] ?>">Shop Now</a>
                        </div>
                     </div>
                  </li>
               <?php } ?>
               </ul>
            </div>
         </div>
      </section>
      <!--//about