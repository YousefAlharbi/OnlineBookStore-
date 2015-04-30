<?php include_once '../includes/helpers.inc.php';

/*
	Author: Noha Salem
	Date: 12 January 2015
	Description: Display the site map to the user
	Special notes:
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

               <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Site Map</div>
				<div class="feat_prod_box_details">
				<p class="details">
				<img src="../images/about.gif" alt="" title="" class="right" />

				<?php
					getDirectory( "../" );
				?>
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