<?php
$pageTitle = "My Cart";

/*
	Author: Faisal Bin Ghimlas
	Date: 20 Dec 2014
	Description: Display the shopping cart
	Special notes:
*/

include_once '../includes/helpers.inc.php';
include '../includes/db.inc.php';
include '../includes/magicquotes.inc.php';
include_once '../includes/cart.inc.php';
require_once "../includes/formvalidator.inc.php";

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

// check if the final order has been submitted
if(isset($_GET['submitorder']))
{
	 $firstname = $_POST['firstname'];
	 $lastName = $_POST['lastName'];
	 $address1 = $_POST['address1'];
	 $address2 = $_POST['address2'];
	 $suburb = $_POST['suburb'];
	 $postcode = $_POST['postcode'];
	 $state = $_POST['state'];
	 $paymenttype = $_POST['paymenttype'];
	 $deliveryinstructions = $_POST['deliveryinstructions'];
	 $deliveryrate=$_POST['deliveryrate'];

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

	    if($validator->ValidateForm())
	    {

	        	try
				{
					// create a random number for use as payment reference
					$paymentref=rand_string(20);

					$sql = 'INSERT INTO orders SET
					custNbr = :customer_nbr,
					orderDate = CURDATE(),
					dispatchDate = CURDATE(),
					deliveryDate =  DATE_ADD(CURDATE(),INTERVAL 2 DAY),
					orderNetValue = :order_net_value,
					deliverTo = :deliver_to,
					deliveryAddress1 = :address1,
					deliveryAddress2 = :address2,
					deliverySuburb = :delivery_suburb,
					deliveryState = :delivery_state,
					deliveryPostCode = :delivery_post_code,
					deliveryInstructions = :delivery_instructions,
					deliveryValue = :delivery_value,
					paymentType = :payment_type,
					paymentRef = :payment_ref';

					$s = $pdo->prepare($sql);
					$s->bindValue(':customer_nbr', $_SESSION['custNbr']);
					$s->bindValue(':order_net_value', $_POST['deliveryRate'] + get_order_total());
					$s->bindValue(':deliver_to', $firstname . ' ' . $lastName);
					$s->bindValue(':address1', $address1);
					$s->bindValue(':address2', $address2);
					$s->bindValue(':delivery_suburb', $suburb);
					$s->bindValue(':delivery_state', $state);
					$s->bindValue(':delivery_post_code', $postcode);
					$s->bindValue(':delivery_instructions', $deliveryinstructions);
					$s->bindValue(':delivery_value', $deliveryrate);
					$s->bindValue(':payment_type', $deliveryrate);
					$s->bindValue(':delivery_value', $deliveryrate);
					$s->bindValue(':payment_type', $paymenttype);
					$s->bindValue(':payment_ref', $paymentref);
					$s->execute();
 					$order_nbr = $pdo->lastInsertId();

					// now insert all the items from the shopping cart
					if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
						$max=count($_SESSION['cart']);
		   				for($i=0;$i<$max;$i++){
		   				$sql = 'INSERT INTO ordereditem SET
								orderNbr = :order_nbr,
								itemCode = :item_code,
								qtyOrdered = :qty_ordered,
								sellingPrice = :selling_price';

								$s = $pdo->prepare($sql);
								$s->bindValue(':order_nbr', $order_nbr);
								$s->bindValue(':item_code', $_SESSION['cart'][$i]['productid']);
								$s->bindValue(':qty_ordered', $_SESSION['cart'][$i]['qty']);
								$s->bindValue(':selling_price', get_price($_SESSION['cart'][$i]['productid']));

								$s->execute();
		   				}
		   			}

					// the shopping cart is done now
					unset($_SESSION['cart']);

		   			header('Location: ../myaccount/?orderhistory');
		   			exit();
				}
				catch (PDOException $e)
				{
				echo $e;

					exit();
				}
				echo "Fatal error creating order";
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
			include 'deliverydisplay.html.php';
			exit();
    	}
}
else if(isset($_GET['checkout']))
{
	$firstname = "";
	$lastName = "";
	$address1 = "";
	$address2 = "";
	$suburb = "";
	$postcode = "";

	if (isset($_GET['checkout']))
	{
		    // get the values from the registration table
		    try
		    {
		    		$sql = 'SELECT * FROM customer WHERE custNbr = :customer_nbr';
		    		$s = $pdo->prepare($sql);
		    		$s->bindValue(':customer_nbr', $_SESSION['custNbr']);
		    		$s->execute();
		    		$row = $s->fetch();

		    		// assign data into the variables so that they can populate onto the delivery form

					$firstname = $row['firstName'];
					$lastname = $row['lastName'];
					$address1 = $row['address1'];
					$address2 = $row['address2'];
					$suburb = $row['suburb'];
					$postcode = $row['postCode'];
					$state = $row['state'];
		    }
		    catch (PDOException $e)
		 	{
		 		$error = 'Login Failed';
		 		$pageTitle = 'Login';
		 		include 'loginform.html.php';
		 		exit();
			}
	}

	// if user is not logged in, then send the user to login page
	if(!isset($_SESSION['loggedin'])) {
		header('Location: ../myaccount/');
		exit();
	}

	$pageTitle='Checkout';
	include 'checkout.html.php';
	exit();
}
else if (isset($_GET['calculatedelivery']))
{
		 $firstname = $_POST['firstname'];
		 $lastname = $_POST['lastname'];
		 $address1 = $_POST['address1'];
		 $address2 = $_POST['address2'];
		 $suburb = $_POST['suburb'];
		 $postcode = $_POST['postcode'];
		 $state = $_POST['state'];

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
			// calculate the delivery price
			// first get the delivery rate
			// get the values from the registration table
			try
			{
					$sql = 'SELECT * FROM delivery WHERE deliveryState = :delivery_state';
					$s = $pdo->prepare($sql);
					$s->bindValue(':delivery_state', $state);
					$s->execute();
					$row = $s->fetch();

					// get delivery rate
					$deliveryRate = $row['deliveryRate'];
			}
			catch (PDOException $e)
			{
				exit();
			}

			// and display the delivery calculation page
			$pageTitle="Delivery Display";
			include 'deliverydisplay.html.php';
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
			include 'checkout.html.php';
			exit();
		}
}
else if(isset($_GET['command']) && $_GET['command']=='delete' && isset($_GET['item_code'])){
	remove_product($_GET['item_code']);
}
else if(isset($_GET['command']) && $_GET['command']=='clear'){
	unset($_SESSION['cart']);
	header('Location: /assignment/books');
	exit();
}
else if(isset($_GET['command']) && $_GET['command']=='update'){
	$max=count($_SESSION['cart']);

	// check that all quantities are numeric
	$error='';
	for($i=0;$i<$max;$i++){
		$pid=$_SESSION['cart'][$i]['productid'];
		$q=$_POST['product'.$pid];
		if(!is_numeric($q))
		{
			$error.="Quantity not numeric for one or more proudcts";
			break;
		}
	}

	if($error=='')
	{
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_POST['product'.$pid];
			$_SESSION['cart'][$i]['qty']=$q;
		}
	}
}

include 'cart.html.php';
?>