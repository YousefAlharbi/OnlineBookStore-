<?php
if(!isset($pageTitle))
{
header('Location: /assignment/shopping/');
}

/*
	Author: Ahmed 
	Date: 20 Dec 14
	Description: Display the cart to the user
	Special notes:
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title><?php htmlout($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<?php
	if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
		$max=count($_SESSION['cart']);
	}
?>
</head>
<body>
<div id="wrap">

      <?php include_once '../includes/header.inc.php'; ?>

       <div class="center_content">
       	<div class="left_content">
	    <div class="error"><?php echo $error; ?></div>

            <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>My cart</div>
       		<?php
       			if($max!=0)
       			{
       		?>
        	<div class="feat_prod_box_details">

			<form method="post" action="?command=update">
            <table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1" width="100%">
		       	<?php
		   			if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
		               	echo '<tr bgcolor="#FFFFFF" style="font-weight:bold"><td>Name</td><td>Price</td><td>Qty</td><td>Amount</td><td>Options</td></tr>';
		   				for($i=0;$i<$max;$i++){
		   					$pid=$_SESSION['cart'][$i]['productid'];
		   					$q=$_SESSION['cart'][$i]['qty'];
		   					$pname=get_product_name($pid);
		   					//if($q==0) continue;
		   			?>
		               		<tr bgcolor="#FFFFFF"><td><?php echo $pname?></td>
		                       <td>$ <?php echo get_price($pid)?></td>
		                       <td><input type="text" name="product<?php echo $pid?>" value="<?php echo $q?>" maxlength="3" size="2" /></td>
		                       <td>$ <?php echo get_price($pid)*$q?></td>
		                       <td><a href="index.php?command=delete&item_code=<?php echo $pid;?>">Remove</a></td></tr>
		               <?php
		   				}
		   			?>
		   				<tr><td colspan="2"><b>Order Total: $<?php echo get_order_total()?></b></td><td colspan="3" align="right">

		   				<a href="index.php?command=clear">Clear Cart</a>&nbsp;&nbsp;
		   				<input type="submit" value="Update Cart"></td></tr>
		   			<?php
		               }
		   			else{
		   				echo "<tr bgColor='#FFFFFF'><td>There are no items in your shopping cart!</td>";
		   			}
		   		?>

        	   </table>
        	   </form>

            <a href="/assignment/books/" class="continue">&lt; continue</a>

            <?php
            	if(isset($_SESSION['cart']))
            	{
            ?>
            	<a href="index.php?checkout" class="checkout">checkout &gt;</a>
			<?php
				}
			?>



            </div>

			<?php
				}
				else
				{
			?>
				<div class="feat_prod_box_details">There are no items in the cart at this stage.</div>
			<?php
				}
			?>




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