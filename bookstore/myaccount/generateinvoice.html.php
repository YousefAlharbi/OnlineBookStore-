<?php
include_once '../includes/helpers.inc.php';
@session_start();
if(!isset($_SESSION['loggedin']))
{
	header('Location: /assignment/myaccount/');
	exit();
}

if(!isset($pageTitle))
{
header('Location: /assignment/myaccount/');
}

/*
	Author: Yousef
	Date: 5 January 2015
	Description: Generate an invoice
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


		<form>
		<input type="button" value="Print Invoice" onClick="window.print()">
		</form>

       <div class="center_content">
       	<div class="left_content">
            <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Invoice</div>

		<div class="feat_prod_box_details">

		<h2>Order details</h2>
		   <strong>Customer Name: </strong> <?php echo $_SESSION['name']."<br/>"; ?>
		   <strong>Order Net value: </strong> $<?php echo $orders[0]['orderNetValue']."<br/>"; ?>
		   <strong>Delivery Value: </strong> $<?php echo $orders[0]['deliveryValue']."<br/>"; ?>

		   <br/>
		   <table class="cart_table">
			  <tr class="cart_title">
				 <td>Order#</td>
				 <td>Order Date</td>
				 <td>Net Value</td>
				 <td>Payment Type</td>
				 <td>Payment Reference</td>
				 <td></td>
			  </tr>
			  <?php if (isset($orders)): ?>
			  <?php foreach ($orders as $order): ?>
			  <tr>
				 <td><?php echo $order['orderNbr'];?></td>
				 <td><?php echo $order['orderDate'];?></td>
				 <td><?php echo $order['orderNetValue'];?></td>
				 <td><?php echo $order['paymentType'];?></td>
				 <td><?php echo $order['paymentRef'];?></td>
				 <td><a target="_new" href = "?generateinvoice=<?php echo $order['orderNbr'];?>">Generate Invoice</a></td>
			  </tr>
			  <?php endforeach; ?>
			  <?php endif; ?>
		   </table>

		   <h2>Delivery Details</h2>
		   <strong>Order Date: </strong> <?php echo $orders[0]['orderDate']."<br/>"; ?>
		   <strong>Dispatch Date: </strong> <?php echo $orders[0]['dispatchDate']."<br/>"; ?>
		   <strong>Delivery Date: </strong> <?php echo $orders[0]['deliveryDate']."<br/>"; ?>
		   <strong>Delivery Address: </strong> <?php echo $orders[0]['deliveryAddress1']; ?> <?php echo $orders[0]['deliveryAddress2']."<br/>"; ?> <?php echo $orders[0]['deliverySuburb']; ?> <?php echo $orders[0]['deliveryState']; ?> <?php echo $orders[0]['deliveryPostCode']."<br/>"; ?>

		   <h2>Ordered Items</h2>
			<table class="cart_table">
			  <tr class="cart_title">
				 <td>Item</td>
				 <td>Quantity</td>
				 <td>Description</td>
				 <td>Category</td>
				 <td>Price</td>
			  </tr>
			  <?php if (isset($orders)): ?>
			  <?php foreach ($orderitems as $order): ?>
			  <tr>
				 <td><?php echo $order['itemCode'];?></td>
				 <td><?php echo $order['qtyOrdered'];?></td>
				 <td><?php echo $order['description'];?></td>
				 <td><?php echo $order['category'];?></td>
				 <td><?php echo $order['sellingPrice'];?></td>
			  </tr>
			  <?php endforeach; ?>
			  <?php endif; ?>
		   </table>

		</div>

        <div class="clear"></div>
        </div>





       <div class="clear"></div>
       </div><!--end of center content-->


      <!--<?php include_once '../includes/footer.inc.php'; ?>-->

</div>

</body>
</html>