<?php
@session_start();

/*
	Author: Faisal Bin Ghimlas
	Date: 14-January-2015
	Description: Home page displays just the specials
	Special notes:
*/


include '../includes/db.inc.php';
include '../includes/magicquotes.inc.php';
include '../includes/cart.inc.php';
$pageTitle = 'Books';
if (isset($_GET['addtocart']) && isset($_GET['itemcode']))
{
	$itemcode=$_GET['itemcode'];
	addtocart($itemcode,1);
	header('Location: ../shopping/');
}
else if (isset($_GET['category']))
{
	try
	{
		$selectedCategory = $_GET['category'];
		$sql = "SELECT * FROM item WHERE category='$selectedCategory'";
		$result = $pdo->query($sql);
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching items from item table!';
		$pageTitle = 'Error';
		include 'error.html.php';
		exit();
	}
}
else{
	try
	{
		$sql = 'SELECT * FROM item';
		$result = $pdo->query($sql);
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching data from item table!';
		$pageTitle = 'Error';
		include 'error.html.php';
		exit();
	}
}
$count=0;
while ($row = $result->fetch())
{
$items[] = array('itemCode' => $row['itemCode'],
'itemName' => $row['itemName'],
'description' => $row['description'],
'category' => $row['category'],
'qtyOnHand' => $row['qtyOnHand'],
'unitPrice' => $row['unitPrice'],
'photo1' => $row['photo1'],
'thumbNail' => $row['thumbNail'],
'featured' => $row['featured']);
$count++;
}
if($count>=1)
	{
	include 'books.html.php';
	exit();
	}
else{
	$error = 'No Books Available to display!';
	$pageTitle = 'Error';
	include 'error.html.php';
	exit();
}
?>