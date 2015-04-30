<?php include_once '../includes/helpers.inc.php';

/*
	Author: Yousef
	Date: 15-December-2014
	Description: The purpose of this page is to display general information about the store
*/

if(!isset($pageTitle))
{
header('Location: /assignment/about/');
}
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

               <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>About Us</div>
				<div class="feat_prod_box_details">
				<p class="details">
				<img src="../images/about.gif" alt="" title="" class="right" />
				Books "R" Us is privately owned and has been
				established for 5 years. The company has grown an average of 5% of turnover per annum in each
				year of its existence.<br/><br/>
				We are a reliable and honest working retailer who respects our customers and will go the
extra yard to ensure our customers are happy and satisfied with their purchase.<br/><br/>
				The shops sell direct to the public, off the shelf or via special orders. The company takes pride in the
fact that no order is too small or too hard to meet.<br/><br/>
Our product range is extensive and up to date. All products are sourced from reputable suppliers
both here in Australia and overseas.<br/><br/> All products we sell come with full manufacturer’s warranties
and applicable instruction manuals.<br/><br/>
Our staff is very knowledgeable about our products and is happy to respond to any enquiries or
customer requests for information of assistance.</p>


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