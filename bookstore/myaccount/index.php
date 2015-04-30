<?php
@session_start();
include '../includes/db.inc.php';
include '../includes/magicquotes.inc.php';
include '../includes/helpers.inc.php';
$pageTitle = 'My Account';
require_once "../includes/formvalidator.inc.php";

/*
	Author: Ahmed
	Date: 5 January 2015
	Description: Home page for my account
	Special notes:
*/

try
{
	$result = $pdo->query('SELECT deliveryState FROM delivery');
}
catch (PDOException $e)
{
	$error = 'Error fetching states from the database!';
	include 'register.html.php';
	exit();
}

foreach ($result as $row)
{
	$states[] = $row[0];
}

if (isset($_GET['getpassword']))
{
	$pageTitle="Retrieve Forgotten Password";
	include 'getpassword.html.php';
	exit();
}
else if (isset($_GET['getpasswordsubmit']))
{
	$email = $_POST['email'];
	if($email=="")
	{
		$error="You must enter your email address";
		include 'getpassword.html.php';
		exit();
	}

	// check if the email is valid
	$sql = 'SELECT custNbr, firstName, lastName FROM customer WHERE email = :email';
	$s = $pdo->prepare($sql);
	$s->bindValue(':email', $email);
	$s->execute();
	$row = $s->fetch();
	if(isset($row['custNbr']) && $row['custNbr']!='')
	{
		// create a random number for use as new password
		$newpassword=rand_string(5);

		// now update the table for the password
		$sql = 'Update Customer Set password=md5(:password) Where email = :email';
		$s = $pdo->prepare($sql);
		$s->bindValue(':email', $email);
		$s->bindValue(':password', $newpassword);
		$s->execute();

		// send email for the password
		$ip=$_SERVER["REMOTE_ADDR"];
		$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);

		$host = $ip.".".$host;

		$body="
		From: shopping@shopping.com.au
		E-mail: shopping@shopping.com.au

		Message:
		Your new password is $newpassword
		";

		$subject="New password";
		$to=$email;
		$emailadd = "From: Shopping Website <shopping@shopping.com.au>";
		@mail($to, $subject, $body, $emailadd);

		$success="An email has been sent you with your password <u>".$newpassword."</u><br/>This password won't be shown here normally but there is no email server. There is code for email also (with error handling)";
		include 'getpassword.html.php';
		exit();
	}
	else
	{
		$error="Your email address does not exist";
		include 'getpassword.html.php';
		exit();
	}

}
else if (isset($_GET['updateprofile']))
{
	$pageTitle="Update Profile";
	$password="";

	// get details of the user to pre populate on the form
	try
	{
			$sql = 'SELECT * FROM customer WHERE custNbr = :customer_nbr';
			$s = $pdo->prepare($sql);
			$s->bindValue(':customer_nbr', $_SESSION['custNbr']);
			$s->execute();
			$row = $s->fetch();

			// assign data into the variables so that they can populate onto the update profile form
			$firstname = $row['firstName'];
			$lastname = $row['lastName'];
			$address1 = $row['address1'];
			$address2 = $row['address2'];
			$suburb = $row['suburb'];
			$postcode = $row['postCode'];
			$state = $row['state'];

			include 'updateprofile.html.php';
			exit();
	}
	catch (PDOException $e)
	{
		$error = 'Login Failed';
		include 'updateprofile.html.php';
		exit();
	}
}
else if (isset($_GET['updateprofilesubmit']))
{
	 $firstname = $_POST['firstname'];
	 $lastname = $_POST['lastname'];
	 $address1 = $_POST['address1'];
	 $address2 = $_POST['address2'];
	 $suburb = $_POST['suburb'];
	 $postcode = $_POST['postcode'];
	 $state = substr($_POST['state'],0,3);
	 $password = $_POST['password'];

	 $validator = new FormValidator();
	 $validator->addValidation('firstname',"maxlen=20","First Name should not exceed 20 characters");
	 $validator->addValidation('lastname',"req","Please fill in Last Name");
	 $validator->addValidation('lastname',"maxlen=45","Last Name should not exceed 45 characters");
	 $validator->addValidation('address1',"maxlen=45","Address Line 1 should not exceed 45 characters");
	 $validator->addValidation('address1',"req","Please fill Address Line 1");
	 $validator->addValidation('address2',"maxlen=45","Address Line 2 should not exceed 45 characters");
	 $validator->addValidation('suburb',"maxlen=45","Suburb should not exceed 45 characters");
	 $validator->addValidation('suburb',"req","Please fill in Suburb");
	 $validator->addValidation('postcode',"req","Please fill in Postcode");
	 $validator->addValidation('postcode',"maxlen=4","Postcode should not exceed 4 digits");
	 $validator->addValidation('postcode',"num","Invalid Postcode!");

	 $validation_errors="";

	 // if all validations are successful
	 if($validator->ValidateForm())
	 {
		// submit the details to the database
		try
		{
				$sql = 'update customer set firstName=:firstName, lastName=:lastName, address1=:address1,
					    address2=:address2,suburb=:suburb,state=:state,postCode=:postcode where custNbr=:custNbr';
				$s = $pdo->prepare($sql);
				$s->bindValue(':firstName', $firstname);
				$s->bindValue(':lastName', $lastname);
				$s->bindValue(':address1', $address1);
				$s->bindValue(':address2', $address2);
				$s->bindValue(':suburb', $suburb);
				$s->bindValue(':state', $state);
				$s->bindValue(':postcode', $postcode);
				$s->bindValue(':custNbr', $_SESSION['custNbr']);
				$s->execute();

				// update password is used attempted ot update the address
				if($password!='')
				{
						$sql = 'update customer set password=md5(:password) where custNbr=:custNbr';
						$s = $pdo->prepare($sql);
						$s->bindValue(':password', $password);
						$s->bindValue(':custNbr', $_SESSION['custNbr']);
						$s->execute();
				}

				// now the update has been successful
				$success="The profile has been updated successfully";
		}
		catch (PDOException $e)
		{
			$error.="There was an issue updating the profile".$e;
			include 'updateprofile.html.php';
			exit();
		}

		// and display the delivery calculation page
		$pageTitle="Update Profile";
		include 'updateprofile.html.php';
		exit();
	}
	else
	{
		//Validations failed. Display Errors.
		$error_hash = $validator->GetErrors();
		foreach($error_hash as $inpname => $inp_err)
		{
		   $error .= "$inp_err<br/>";
		}
		include 'updateprofile.html.php';
		exit();
	}
}
else if (isset($_GET['generateinvoice']))
{
	try
	{
		$sql = "SELECT * FROM orders where orderNbr=" . $_GET['generateinvoice'];
		$result = $pdo->query($sql);
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching orders from order table!';
		$pageTitle = 'Error';
		include 'error.html.php';
		exit();
	}
	while ($row = $result->fetch())
	{
		$orders[] = array('orderNbr' => $row['orderNbr'],
		'custNbr' => $row['custNbr'],
		'orderDate' => $row['orderDate'],
		'dispatchDate' => $row['dispatchDate'],
		'deliveryDate' => $row['deliveryDate'],
		'orderNetValue' => $row['orderNetValue'],
		'deliverTo' => $row['deliverTo'],
		'deliveryAddress1' => $row['deliveryAddress1'],
		'deliveryAddress2' => $row['deliveryAddress2'],
		'deliverySuburb' => $row['deliverySuburb'],
		'deliveryState' => $row['deliveryState'],
		'deliveryPostCode' => $row['deliveryPostCode'],
		'deliveryInstructions' => $row['deliveryInstructions'],
		'deliveryValue' => $row['deliveryValue'],
		'paymentType' => $row['paymentType'],
		'paymentRef' => $row['paymentRef']
		);
	}

	try
	{
		$sql = "SELECT ordereditem.*, item.itemName, item.description, item.category FROM ordereditem, item where ordereditem.itemCode=item.itemCode and orderNbr=" . $_GET['generateinvoice'];
		$result = $pdo->query($sql);
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching orders from order table!';
		$pageTitle = 'Error';
		echo $e;
		//include 'error.html.php';
		exit();
	}
	while ($row = $result->fetch())
	{
		$orderitems[] = array('orderNbr' => $row['orderNbr'],
		'itemCode' => $row['itemCode'],
		'qtyOrdered' => $row['qtyOrdered'],
		'sellingPrice' => $row['sellingPrice'],
		'itemName' => $row['itemName'],
		'description' => $row['description'],
		'category' => $row['category'],
		);
	}

	include('generateinvoice.html.php');
	exit();
}
else if (isset($_GET['orderhistory']))
{
	$pageTitle='Order History';

	try
	{
		$sql = "SELECT * FROM orders where custNbr=" . $_SESSION['custNbr'];
		$result = $pdo->query($sql);
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching orders from order table!';
		$pageTitle = 'Error';
		include 'error.html.php';
		exit();
	}
	while ($row = $result->fetch())
	{
		$orders[] = array('orderNbr' => $row['orderNbr'],
		'custNbr' => $row['custNbr'],
		'orderDate' => $row['orderDate'],
		'dispatchDate' => $row['dispatchDate'],
		'deliveryDate' => $row['deliveryDate'],
		'orderNetValue' => $row['orderNetValue'],
		'deliverTo' => $row['deliverTo'],
		'deliveryAddress1' => $row['deliveryAddress1'],
		'deliveryAddress2' => $row['deliveryAddress2'],
		'deliverySuburb' => $row['deliverySuburb'],
		'deliveryState' => $row['deliveryState'],
		'deliveryPostCode' => $row['deliveryPostCode'],
		'deliveryInstructions' => $row['deliveryInstructions'],
		'deliveryValue' => $row['deliveryValue'],
		'paymentType' => $row['paymentType'],
		'paymentRef' => $row['paymentRef']
		);
	}

	include('orderhistory.html.php');
	exit();
}
else if (isset($_GET['logincustomer']))
{
   $email = mysql_real_escape_string($_POST['email']);
   $password = mysql_real_escape_string($_POST['password']);
   try
   {
   		$sql = 'SELECT custNbr, firstName, lastName FROM customer WHERE email = :email AND passWord = md5(:password)';
   		$s = $pdo->prepare($sql);
   		$s->bindValue(':email', $email);
   		$s->bindValue(':password', $password);
   		$s->execute();
   		$row = $s->fetch();
   		if(isset($row['custNbr']) && $row['custNbr']!='')
   		{
			$_SESSION['loggedin'] = "YES";
			$_SESSION['custNbr'] = $row['custNbr'];
			$_SESSION['name']  = $row['firstName'] . " " . $row['lastName'];
		}
		else
		{
			//session_destroy();
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
if(!isset($_SESSION['loggedin']))
{
	$pageTitle = 'Login';
	$error = 'Please login to access your account.';
	include 'loginform.html.php';
	exit();
}
include 'myaccount.html.php';
exit();
?>