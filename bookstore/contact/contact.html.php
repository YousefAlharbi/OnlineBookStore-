<?php include_once '../includes/helpers.inc.php';
if(!isset($pageTitle))
{
header('Location: /assignment/contact/');
}

/*
	Author: Abdullah 
	Date: 2-January-2015
	Description: Render the contact page
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

               <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Contact Us</div>
				<div class="feat_prod_box_details">
				 <div class="contact_form">
				   <div class="form_subtitle">Melbourne Store</div>
					<table class="contact_table">
					  <tr>
						<th>Address:</th>
						<td>17 Lonsdale St, Melbourne</td>
					  </tr>
					  <tr>
						<th>Phone Nbr:</th>
						<td>03 9500 4321</td>
					  </tr>
					  <tr>
						<th>Fax Nbr:</th>
						<td>03 9500 4322</td>
					  </tr>
					  <tr>
						<th>Trading	Hours:</th>
						<td>9 am to 5:30 pm (M -Th)</td>
					  </tr>
					  <tr>
						<th></th>
						<td>9 am to 9 pm (Fri)</td>
					  </tr>
					  <tr>
						<th></th>
						<td>10 am to 6 pm (Sat)</td>
					  </tr>
					  <tr>
						<th></th>
						<td>10 am to 3 pm (Sun)</td>
					  </tr>
					</table>
				 </div>
               </div>
               <div class="clear"></div>
               <div class="feat_prod_box_details">
				 <div class="contact_form">
				   <div class="form_subtitle">Geelong Store</div>
					<table class="contact_table">
					  <tr>
					    <th>Address:</th>
					    <td>114 Ryrie St, Geelong</td>
					  </tr>
					  <tr>
					    <th>Phone Nbr:</th>
					    <td>03 5988 2468</td>
					  </tr>
					  <tr>
						<th>Fax Nbr:</th>
						<td>03 5988 3276</td>
					  </tr>
					  <tr>
						<th>Trading	Hours:</th>
						<td>9:30 am to 5 pm (M -Th)</td>
					  </tr>
					  <tr>
						<th></th>
						<td>9 am to 9 pm (Fri)</td>
					  </tr>
					  <tr>
						<th></th>
						<td>10 am to 5 pm (Sat)</td>
					  </tr>
					  <tr>
						<th></th>
						<td>10 am to 2 pm (Sun)</td>
					  </tr>
					</table>
				 </div>
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