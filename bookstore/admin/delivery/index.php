<?php
include '../../includes/db.inc.php';
include '../../includes/magicquotes.inc.php';
$pageTitle = 'Delivery Rates';

/*
	Author: Yousef
	Date: 5-January-2015
	Description: Render the form that will allow the administrator to enter delivery rates for the different states
	Special notes:
*/

$error = '';
if (isset($_GET['edit']))
{
$deliveryState = $_GET['edit'];
try
	{
		$sql = "SELECT * FROM delivery WHERE deliveryState = '$deliveryState'";
		$result = $pdo->query($sql);
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching data from delivery table!';
		$pageTitle = 'Error';
		include 'deliveryform.html.php';
		exit();
	}
$count=0;
while ($row = $result->fetch())
	{
	$deliveries[] = array('deliveryState' => $row['deliveryState'],
	'deliveryRate' => $row['deliveryRate']);
	}
include 'deliveryform.html.php';
exit();
}



else if (isset($_GET['editform']))
	{
	$deliveryState=$_POST['deliveryState'];
	$deliveryRate=$_POST['deliveryRate'];
	if(!is_numeric($deliveryRate))
		{
		$error = "Not a valid input";
		header('Location: index.php?edit='.$deliveryState."&error=".urlencode($error));
		exit();
		}
	else
		{
	    try{
			$sql = "UPDATE delivery SET
			deliveryRate = :deliveryRate
			WHERE deliveryState = :deliveryState";
			$s = $pdo->prepare($sql);
			$s->bindValue(':deliveryState', $deliveryState);
			$s->bindValue(':deliveryRate', $deliveryRate);
			$s->execute();
			}
		catch(PDOException $e)
			{
			//echo $sql;
			//echo $s;
			//exit();
			$error = "Error updating Delivery Table";
			header('Location: index.php?edit='.$deliveryState."&error=".urlencode($error));
			exit();
			}
			header('Location:/assignment/admin/delivery/');
			exit();

		}
}





else
{
try
	{
		$sql = 'SELECT * FROM delivery';
		$result = $pdo->query($sql);
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching data from delivery table!';
		$pageTitle = 'Error';
		include 'deliveryform.html.php';
		exit();
	}
$count=0;
while ($row = $result->fetch())
	{
	$deliveries[] = array('deliveryState' => $row['deliveryState'],
	'deliveryRate' => $row['deliveryRate']);
	}
include 'deliveryform.html.php';
exit();

}

?>