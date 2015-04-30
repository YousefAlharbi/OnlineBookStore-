<?php
@session_start();

/*
	Author: Yousef 
	Date: 7 Jan 15
	Description: Administrator login apge
	Special notes: The details of all administrators are stored in the database
*/

include '../includes/db.inc.php';
include '../includes/magicquotes.inc.php';
$pageTitle = 'Administration';


if (isset($_GET['loginadmin']))
{
   $adminId = mysql_real_escape_string($_POST['adminId']);
   $password = mysql_real_escape_string($_POST['password']);
   try
   {
   		$sql = 'SELECT adminId, firstName, lastName FROM admin WHERE adminId = :adminId AND passWord = md5(:password)';
   		$s = $pdo->prepare($sql);
   		$s->bindValue(':adminId', $adminId);
   		$s->bindValue(':password', $password);
   		$s->execute();
   		$row = $s->fetch();
   		if(isset($row['adminId']) && $row['adminId']!='')
   		{
			$_SESSION['adminloggedin'] = "YES";
			$_SESSION['adminId'] = $row['adminId'];
			$_SESSION['name']  = $row['firstName'] . " " . $row['lastName'];
		}
		else
		{
			session_destroy();
			$error = 'Login Failed';
			$pageTitle = 'Login';
			include 'loginform.html.php';
			exit();
		}
   }
   catch (PDOException $e)
	{
		$error = 'Login Failed';
		$pageTitle = 'Login';
		include 'loginform.html.php';
		exit();
	}

}
if(!isset($_SESSION['adminloggedin']))
{
	$pageTitle = 'Login';
	$error = 'Please login to access your account.';
	include 'loginform.html.php';
	exit();
}
include 'myaccount.html.php';
exit();
?>