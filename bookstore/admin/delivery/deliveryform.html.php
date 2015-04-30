<?php
include_once '../../includes/helpers.inc.php';
@session_start();
if(!isset($_SESSION['adminloggedin']))
{
	header('Location: /assignment/admin/');
	exit();
}
if((!isset($pageTitle))||($pageTitle==''))
{
	header('Location: /assignment/admin/delivery');
	exit();
}

/*
	Author: Yousef
	Date: 22-December-2014
	Description: Set the delivery rate for different states
	Special notes:
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title><?php htmlout($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="../../css/style.css" />
</head>
<body>
<div id="wrap">

       <?php include_once '../../includes/header.inc.php'; ?>

       <div class="center_content">
       	<div class="left_content">
       	<?php if (isset($_GET['error']))
       	$error = $_GET['error']; ?>
       	 <div class="error"><?php echo $error; ?></div>
         <div class="title"><span class="title_icon"><img src="../../images/bullet1.gif" alt="" title="" /></span>Manage Products</div>
		<div class="feat_prod_box_details">

		            <table class="cart_table">
		            	<tr class="cart_title">
		                	<td>State</td>
		                	<td>Rate</td>
		                	<td>Edit</td>

		                </tr>
		                <?php if (isset($deliveries)): ?>
		                <?php foreach($deliveries as $delivery):
		                if((isset($deliveryState))&&($delivery['deliveryState']== $deliveryState))
		                {  ?>
		            	 <tr>
		            	 <form method="post" action="?editform">
						<td><?php echo $delivery['deliveryState'];?></td>
						<td><input type="text" name="deliveryRate" id="deliveryRate" class="delivery_input" value="<?php echo $delivery['deliveryRate'];?>" />
						<input type="hidden" name="deliveryState" id="deliveryState" value="<?php echo $delivery['deliveryState'];?>" />
						</td>
						<td><input type="submit" name="btnSubmit" value="Submit"/></a></td>
						</form>
		                </tr>
		                <?php
		                }
		                else
		                { ?>
		                <tr>
						<td><?php echo $delivery['deliveryState'];?></td>
						<td><?php echo $delivery['deliveryRate'];?></td>
						<td><a href = "?edit=<?php echo $delivery['deliveryState'];?>">Edit</a></td>
						</tr>
		                 <?php
		                }
		                endforeach; ?>

						<?php endif; ?>


		            </table>



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