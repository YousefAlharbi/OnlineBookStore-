<?php

	include_once 'cart.inc.php';

	/*
		Author: Noha Salem
		Date: 25 December 2014
		Description: Setup the contents of the cart so that they can be rendered
		Special notes:
	*/

	if(isset($_SESSION['cart']))
	{
		$max=count($_SESSION['cart']);
		$totalcartvalue=0;
		$totalqty=0;

		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$amount=get_price($pid)*$q;
			$totalqty=$totalqty+$q;
			$totalcartvalue=$totalcartvalue+$amount;
		}
	}
	else
	{

		$amount=0;
		$totalqty=0;
		$totalcartvalue=0;
	}
?>

<div class="cart">
	<div class="title"><span class="title_icon"><img src="/assignment/images/cart.gif" alt="" title="" /></span>My cart</div>
	<div class="home_cart_content">
		<?php echo $totalqty;?> x items | <span class="red">TOTAL: <?php echo $totalcartvalue;?>$</span>
	</div>
	<a href="/assignment/shopping/" class="view_cart">view cart</a>
</div>