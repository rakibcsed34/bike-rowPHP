<?php 
   require_once('admin/db.php'); 
   $db = new DB();

   $selectSql = "SELECT * FROM slider ORDER BY slider_id DESC";
   $dataSlider = $db->selectData($selectSql);

   $i = 0;
   foreach ($dataSlider as $key => $slider) {
      $i++;
?>
<style type="text/css">
   .<?php echo 'one'.$i; ?>-img{  background: url(<?php echo 'admin/uploads/slider/'.$slider['slider_image'] ?>)no-repeat center;}
   .one1-img{
      width: 100%;
      height: 300px;

   }
</style>
<?php } ?>
<div class="slider text-center">
   <div class="callbacks_container">
      <ul class="rslides" id="slider4">
         <?php
            $i = 0;
            foreach ($dataSlider as $key => $slider) {
               $i++;
         ?>
         
         <li>
            <div class="slider-img <?php echo 'one'.$i; ?>-img">
               <div class="container">
                  <div class="slider-info ">
                     <h5><?php echo $slider['slider_title']; ?></h5>
                  </div>
               </div>
            </div>
         </li>
       <?php } ?>
      </ul>
   </div>
   <!-- This is here just to demonstrate the callbacks -->
   <!-- <ul class="events">
      <li>Example 4 callback events</li>
      </ul>-->
   <div class="clearfix"></div>
</div>