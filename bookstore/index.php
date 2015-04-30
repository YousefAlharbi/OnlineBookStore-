<?php
include 'includes/db.inc.php';
include 'includes/magicquotes.inc.php';

/*
	Author: Ahmed Alshamisi
	Date: 9 December 2014
	Description: Display the home page for books "r" us
	Special notes:
*/

$pageTitle = 'Books "R" Us';
try
{
	$sql = "SELECT * FROM item WHERE featured = TRUE";
	$result = $pdo->query($sql);
}
catch (PDOException $e)
{
	$error = 'Error fetching featured items from item table!';
	$pageTitle = 'Error';
	include '/assignment/books/error.html.php';
	exit();
}
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
}

include 'index.html.php';
?>