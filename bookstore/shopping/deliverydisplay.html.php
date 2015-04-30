<?php
@session_start();

if(!isset($pageTitle))
{
header('Location: /assignment/shopping/');
}

/*
	Author: Noha Salem
	Date: 12 January 2015
	Description: Display the delivery cost to the user
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
			<form method="post" action="?submitorder">

			<div class="feat_prod_box_details">
			<?php echo $firstname;?>
			<?php echo $lastname;?>
			<br/><?php echo $address1;?>
			<br/><?php echo $address2;?>
			<?php if(isset($address2) && $address2!='') { ?>
			<br/>
			<?php } ?>
			<?php echo $suburb;?>
			<br/><?php echo $state;?>
			<br/><?php echo $postcode;?>
			<br/>Delivery Charges : $<?php echo $deliveryRate;?>
			</div>

			<input type="hidden" name="firstname" id="firstname" class="contact_input" value="<?php echo $firstname;?>" />
			<input type="hidden" name="lastname" id="lastname" class="contact_input" maxlength="45" value="<?php echo $lastname;?>"/>
			<input type="hidden" name="address1" id="address1" class="contact_input" maxlength="45" value="<?php echo $address1;?>"/>
			<input type="hidden" name="address2" id="address2" class="contact_input" maxlength="45" value="<?php echo $address2;?>"/>
			<input type="hidden" name="suburb" id="suburb" class="contact_input" maxlength="45" value="<?php echo $suburb;?>"/>
			<input type="hidden" name="state" id="state" class="contact_input" maxlength="45" value="<?php echo $state;?>"/>
			<input type="hidden" name="postcode" id="postcode" class="contact_input" maxlength="4" value="<?php echo $postcode;?>"/>
			<input type="hidden" name="deliveryrate" id="deliveryrate" class="contact_input" maxlength="4" value="<?php echo $deliveryRate;?>"/>

			<div class="form_row">
			   <label class="contact"><strong>*Instructions:</strong></label>
			   <textarea rows="5" cols="50" name="deliveryinstructions" class="contact_input"><?php echo $deliveryinstructions;?></textarea>
			</div>
			<div class="form_row">
			   <label class="contact"><strong>*Payment type:</strong></label>
			   <select name="paymenttype" id="paymenttype" >
					<option value="MC">MasterCard</option>
					<option value="VC">Visa</option>
					<option value="AE">American Express</option>
					<option value="DC">Diner's Club</option>
					<option value="PP">Paypal</option>
					<option value="BP">BPay</option>
			   </select>
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



		   				<input type="submit" value="Submit Order"></td></tr>
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