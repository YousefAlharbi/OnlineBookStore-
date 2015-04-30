<?php
	/*
		Author: Yousef
		Date: 10 December 2014 to 4 January 2015
		Description: This page includes the code to setup the variatbles that will eventually render the shopping cart on cartdisplay.inc.php
		Special notes:
	*/

	@mysql_connect("localhost","root","") or die("Unable to make a connection with the store database! sorry :(");
	@mysql_select_db("shoppingdb") or die("Unable to make a connection with the store database! sorry :(");
	@session_start();

	function get_product_name($item_code){
		$result=mysql_query("select itemName from item where itemCode='$item_code'") or die("select itemName from item where itemCode=$itemCode"."<br/><br/>".mysql_error());
		$row=mysql_fetch_array($result);
		return $row['itemName'];
	}
	function get_price($item_code){
		$result=mysql_query("select unitPrice from item where itemCode='$item_code'") or die("select itemName from item where itemCode=$item_code"."<br/><br/>".mysql_error());
		$row=mysql_fetch_array($result);
		return $row['unitPrice'];
	}
	function remove_product($item_code){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			if($item_code==$_SESSION['cart'][$i]['productid']){
				unset($_SESSION['cart'][$i]);
				break;
			}
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
	}

	function get_order_total(){
		$max=count($_SESSION['cart']);
		$sum=0;
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid);
			$sum+=$price*$q;
		}
		return $sum;
	}

	function addtocart($item_code,$q){

		if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
			//if(product_exists($item_code)) return;
			$max=count($_SESSION['cart']);

			$index=-1;
			$found=false;
			//find the index where the product is
			for($i=0;$i<$max;$i++){
				$pid=$_SESSION['cart'][$i]['productid'];
				if($pid==$item_code) {
					$index=$i;
					$found=true;
					break;
				}
			}

			// if no index found then insert at the last location
			if($found==false)
			{
				$index=$max;
			}

			if($found==true)
			{
				$_SESSION['cart'][$index]['qty']=$_SESSION['cart'][$index]['qty']+$q;
			}
			else
			{
				$_SESSION['cart'][$index]['productid']=$item_code;
				$_SESSION['cart'][$index]['qty']=1;
			}
		}
		else{
			$_SESSION['cart']=array();
			$_SESSION['cart'][0]['productid']=$item_code;
			$_SESSION['cart'][0]['qty']=$q;
		}
	}
	function product_exists($item_code){
		$max=count($_SESSION['cart']);
		$flag=0;
		for($i=0;$i<$max;$i++){
			if($item_code==$_SESSION['cart'][$i]['productid']){
				$flag=1;
				break;
			}
		}
		return $flag;
	}

?>