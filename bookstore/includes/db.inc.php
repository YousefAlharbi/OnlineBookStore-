<?php

/*
	Author: Ahmed
	Date: 22 Dec 14
	Description: Setup the database connection here
	Special notes:
*/

try
{
	$pdo = new PDO('mysql:host=localhost;dbname=shoppingdb', 'root','');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
	$error = 'A connection with the database failed.'.$e;
	include 'error.html.php';
	exit();
}
?>