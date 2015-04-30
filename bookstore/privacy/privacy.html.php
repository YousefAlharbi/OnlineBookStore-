<?php include_once '../includes/helpers.inc.php';

/*
	Author: Abdullah 
	Date: 5 January 2015
	Description:  Display the privacy page
	Special notes:
*/

if(!isset($pageTitle))
{
header('Location: /assignment/privacy/');
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

               <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Privacy Policy</div>
				<div class="feat_prod_box_details">
				<p class="details">

				Books "R" Us does not collect personal information unless it is necessary for us to carry out our functions and activities as a retailer.

<br/><br/>We only collect such information by lawful and fair means and in an unobtrusive way. You may provide us with personal information about yourself or others each time you contact us by phone, fax, letter or email.<br/><br/>

We need to use this information to provide you with our services and/or products.<br/><br/>You have the right to request access to the personal information you provide, and to correct or update your personal information. This right is subject to certain exceptions allowed by law.

<br/><br/>You may instruct us to remove any previous consent you provided to receive marketing communications from us.
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