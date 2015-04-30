<?php
include_once '../../includes/helpers.inc.php';
if(!isset($pageTitle))
{
header('Location: /assignment/admin/products/');
}
@session_start();
if(!isset($_SESSION['adminloggedin']))
{
	header('Location: /assignment/admin/');
	exit();
}

/*
	Author: Ahmed
	Date: 12-January-2015
	Description: Form to add a new product in the database
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
         <div class="title"><span class="title_icon"><img src="../../images/bullet1.gif" alt="" title="" /></span>Add Product</div>
		                  <div class="feat_prod_box_details">
		                   <div class="contact_form">
		                      <div class="form_subtitle">Fields marked * are compulsory</div>
		                      <form name="addproduct" action="?<?php htmlout($action); ?>" method="post" enctype="multipart/form-data">
                     		<div class="form_row">
		                     <label class="contact"><strong>*Product Code:</strong></label>
		                     <?php if($pageTitle != 'Edit Product'){ ?>
		                     <input type="text" name="itemCode" id="itemCode" class="contact_input" maxlength="10" value="<?php echo $itemCode;?>"/>
		                     <?php }else{  ?>
		                     <label class="contact_input"><strong><?php htmlout($itemCode); ?></strong></label>
		                     <input type="hidden" name="itemCode" id="itemCode" class="contact_input" maxlength="10" value="<?php echo $itemCode;?>"/>

		                     <?php } ?>
		                     </div>

		                     <div class="form_row">
							 <label class="contact"><strong>*Product Name:</strong></label>
							 <input type="text" name="itemName" id="itemName" class="contact_input" maxlength="25" value="<?php echo $itemName;?>"/>
 							 </div>

 							 <div class="form_row">
							<label class="contact"><strong>*Category:</strong></label>
							<select name="category" id="category" >
							<?php foreach ($categories as $category1) { ?>
							   <?php
							   	if($category1==$category)
							   	{
							   		$option="selected='selected'";
							   	}
							   	else
							   	{
							   		$option="";
							   	}
							   ?>
							   <option value="<?php htmlout($category1); ?>" <?php echo $option;?>><?php htmlout($category1); ?></option>
							<?php } ?>
							</select>
                        	</div>

 							 <div class="form_row">
							 <label class="contact"><strong>*Quantity On Hand:</strong></label>
							 <input type="number" name="qtyOnHand" id="qtyOnHand" class="contact_input" value="<?php echo $qtyOnHand;?>"/>
							 </div>

							 <div class="form_row">
							 <label class="contact"><strong>*Unit Price:</strong></label>
							 <input name="unitPrice" id="unitPrice" class="contact_input" value="<?php echo $unitPrice;?>"/>
 							 </div>


		                     <div class="form_row">
		                     <label class="contact"><strong>*Description:</strong></label>
		                     <textarea name="description" id="description" class="contact_textarea" maxlength="255"><?php echo $description;?></textarea>
		                     </div>

		                     <div class="form_row">
		                     <label class="contact"><strong>Featured:</strong></label>
		                     <?php
		                     	if($featured==true)
		                     		$val='checked';
		                     	else
		                     		$val='';
		                     ?>
		                     <input type="checkbox" name="featured" id="featured" value="featured" <?php echo $val;?>>
		                     </div>

		                      <?php if($pageTitle != 'Edit Product'){ ?>
		                     <div class="form_row">
		                     <label class="contact" for="file"><strong>*Photo 1:</strong></label>
							 <input type="file" name="photo1" id="photo1" />
							 </div>

							 <div class="form_row">
							 <label class="contact" for="file"><strong>Photo 2:</strong></label>
							 <input type="file" name="photo2" id="photo2" />
							 </div>

							 <div class="form_row">
							 <label class="contact" for="file"><strong>Photo 3:</strong></label>
							 <input type="file" name="photo3" id="photo3" />
							 </div>

							 <div class="form_row">
							 <label class="contact" for="file"><strong>*Thumbnail:</strong></label>
							 <input type="file" name="thumbNail" id="thunmNail" />
							 </div>
							 <?php } ?>



		                     <div class="form_row">
		                     <input type="submit" name="<?php echo $button;?>" value="<?php echo $button;?>"/>
		                     </div>
		                 	</div>
		                 	 </form>




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