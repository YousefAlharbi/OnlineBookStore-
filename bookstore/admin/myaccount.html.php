<?php
include_once '../includes/helpers.inc.php';
if(!isset($pageTitle))
{
header('Location: /assignment/myaccount/');
}
@session_start();
if(!isset($_SESSION['adminloggedin']))
{
	header('Location: /assignment/admin/');
	exit();
}

/*
	Author: Yousef
	Date: 10 Jan 15
	Description: Home page after the administrator has logged in successfully
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
         <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>My account</div>
		<div class="feat_prod_box_details">
		<ul class="list">
		<li><a href="products/">Manage Products</a></li>
		<li><a href="delivery/">Manage Delivery Rates</a></li>
		</ul>
		</div>




        <div class="clear"></div>
        </div><!--end of left content-->
		         <div class="right_content">




			</div><!--end of right content-->




		       <div class="clear"></div>
		       </div><!--end of center content-->



      <div class="footer">
	      <div class="left_footer">&copy; Books "R" Us</div>
	      <div class="right_footer">
	      </div>
</div>

</div>

</body>
</html>