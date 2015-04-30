<?php
@session_start();

if(!isset($pageTitle))
{
header('Location: /assignment/shopping/');
}

/*
	Author: Yousef
	Date: 5 January 2015
	Description: Display the checkout page to the user
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
       		<div class="error"><?php echo $error; ?></div>

            <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Checkout</div>



			<!-- Beginning of the checkout form -->
			<form method="post" action="?calculatedelivery">

			<div class="form_row">
									<label class="contact"><strong>First Name:</strong></label>
									<input type="text" name="firstname" id="firstname" class="contact_input" value="<?php echo $firstname;?>" />
									</div>
									<div class="form_row">
									<label class="contact"><strong>*Last Name:</strong></label>
									<input type="text" name="lastname" id="lastname" class="contact_input" maxlength="45" value="<?php echo $lastname;?>"/>
									</div>
									<div class="form_row">
									   <label class="contact"><strong>*Address 1:</strong></label>
									   <input type="text" name="address1" id="address1" class="contact_input" maxlength="45" value="<?php echo $address1;?>"/>
									</div>
									<div class="form_row">
									   <label class="contact"><strong>Address 2:</strong></label>
									   <input type="text" name="address2" id="address2" class="contact_input" maxlength="45" value="<?php echo $address2;?>"/>
									</div>
									<div class="form_row">
									   <label class="contact"><strong>*Suburb:</strong></label>
									   <input type="text" name="suburb" id="suburb" class="contact_input" maxlength="45" value="<?php echo $suburb;?>"/>
									</div>
									<div class="form_row">
									   <label class="contact"><strong>*State:</strong></label>
									   <select name="state" id="state" >
									   <?php foreach ($states as $state) { ?>
										  <option value="<?php htmlout($state); ?>"><?php htmlout($state); ?></option>
									   <?php } ?>
									   </select>
									</div>
									<div class="form_row">
									   <label class="contact"><strong>*Postcode:</strong></label>
			 						   <input type="text" name="postcode" id="postcode" class="state_postcode" maxlength="4" value="<?php echo $postcode;?>"/>
									</div>

			<!-- End of the checkout form -->


        	<div class="feat_prod_box_details">

            <table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
		       	<?php
		   			if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
		               	echo '<tr bgcolor="#FFFFFF" style="font-weight:bold"><td>Name</td><td>Price</td><td>Qty</td><td>Amount</td></tr>';
		   				$max=count($_SESSION['cart']);
		   				for($i=0;$i<$max;$i++){
		   					$pid=$_SESSION['cart'][$i]['productid'];
		   					$q=$_SESSION['cart'][$i]['qty'];
		   					$pname=get_product_name($pid);
		   					//if($q==0) continue;
		   			?>
		               		<tr bgcolor="#FFFFFF"><td><?php echo $pname?></td>
		                       <td>$ <?php echo get_price($pid)?></td>
		                       <td><?php echo $q?></td>
		                       <td>$ <?php echo get_price($pid)*$q?></td>
		                       </tr>
		               <?php
		   				}
		   			?>
		   				<tr><td colspan="2"><b>Order Total: $<?php echo get_order_total()?></b></td><td colspan="3" align="right">



		   				<input type="submit" value="Calculate Delivery"></td></tr>
		   			<?php
		               }
		   			else{
		   				echo "<tr bgColor='#FFFFFF'><td>There are no items in your shopping cart!</td>";
		   			}
		   		?>

        	   </table>
        	   </form>



            <?php
            	if(isset($_SESSION['cart']))
            	{
            ?>

			<?php
				}
			?>


            </div>


        <div class="clear"></div>
        </div><!--end of left content-->
         <div class="right_content">

		                 <?php include_once '../includes/cartdisplay.inc.php'; ?>

        <div class="right_box">
					<?php require_once '../includes/categories.inc.php'; ?>
		</div><!--end of right content-->



       <div class="clear"></div>
       </div><!--end of center content-->


      <?php include_once '../includes/footer.inc.php'; ?>
</div>

</body>
</html>