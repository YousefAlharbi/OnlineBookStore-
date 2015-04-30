<?php include_once '../includes/helpers.inc.php';
if(!isset($pageTitle))
{
header('Location: /assignment/faq/');
}

/*
	Author: Abdullah
	Date: 2-January-2015
	Description: The FAQ Page
	Special notes:
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
      <title><?php htmlout($pageTitle); ?></title>
      <link rel="stylesheet" type="text/css" href="../css/style.css" />
   </head>
   <body>
      <div id="wrap">
       <?php include_once '../includes/header.inc.php'; ?>
         <div class="center_content">
            <div class="left_content">

               <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Frequently Asked Questions</div>
				<div class="feat_prod_box_details">
				<p class="details">

				<strong>Q: Is there a warranty on the products?</strong><br/>
				Yes, there is a 3 month warranty.
				<br/><br/>
				<strong>Q: How can I return an item?</strong><br/>
				Please <a href="../contact">contact us</a> and we will explain the procedure to you.
				<br/><br/>
				<strong>Q: How much is the delivery fees?</strong><br/>
				The delivery fees depends on the state where it is being delivered to. It is calculated before you submit your order.
				<br/><br/>

				</p>


				</div>

               <div class="clear"></div>
            </div>
            <!--end of left content-->
            <div class="right_content">
              <?php include_once '../includes/cartdisplay.inc.php'; ?>
               <div class="right_box">
                 <?php require_once '../includes/categories.inc.php'; ?>


            </div>
            <!--end of right content-->
            <div class="clear"></div>
         </div>
         <!--end of center content-->
         <?php include_once '../includes/footer.inc.php'; ?>
      </div>
    </body>
</html>