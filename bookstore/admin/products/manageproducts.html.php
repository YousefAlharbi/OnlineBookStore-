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
	header('Location: /assignment/admin/products');
	exit();
}

/*
	Author: Ahmed
	Date: 8-January-2015
	Description: Render the form that will allow the user to delete, add, update products
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
       	 <div class="error"><?php echo $error; ?></div>
         <div class="title"><span class="title_icon"><img src="../../images/bullet1.gif" alt="" title="" /></span>Manage Products</div>
		<div class="feat_prod_box_details">

		            <table class="cart_table">
		            	<tr class="cart_title">
		                	<td>Book Name</td>
		                	<td>Category</td>
		                	<td>Quantity</td>
		                    <td>Unit price</td>
		                    <td>Edit</td>
		                    <td>Delete</td>
		                </tr>
		                <?php if (isset($items)): ?>
		                <?php foreach ($items as $item): ?>


		            	<tr>
							<td><?php echo $item['itemName'];?></td>
							<td><?php echo $item['category'];?></td>
							<td><?php echo $item['qtyOnHand'];?></td>
							<td>$ <?php echo $item['unitPrice'];?></td>
							<td><a href = "?edit=<?php echo $item['itemCode'];?>">Edit</a></td>
							<td><!--<a href = "?delete=<?php echo $item['itemCode'];?>">Delete</a>-->Delete Not Allowed</td>
		                </tr>
		                <?php endforeach; ?>

						<?php endif; ?>





		            </table>



            </div>




        <div class="clear"></div>
        </div><!--end of left content-->
		         <div class="right_content">
					<div class="cart">
					<div class="title"><span class="title_icon"><a href="?add"><img src="/assignment/images/button_add.gif" alt="" title="" /></a></span>
					<a href="?add" class ="new_product">Add Product</a></div>

					</div>



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