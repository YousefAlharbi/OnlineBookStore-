<?php
include '../includes/db.inc.php';
include '../includes/magicquotes.inc.php';
$pageTitle = 'New Customer';
/*
	Author: Ahmed
	Date: 5 January 2015
	Description: Display the registration page to the user
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

require_once "../includes/formvalidator.inc.php";

if (isset($_GET['addcustomer']))
{
	 $firstname = $_POST['firstname'];
	$lastName = $_POST['lastname'];
	$email = $_POST['email'];
	$passWord = $_POST['passWord'];
	$address1 = $_POST['address1'];
	$address2 = $_POST['address2'];
	$suburb = $_POST['suburb'];
	$postcode = $_POST['postcode'];
	$state = substr($_POST['state'],0,3);

	 $validator = new FormValidator();
	 $validator->addValidation('firstname',"maxlen=20","First Name should not exceed 20 characters");
	 $validator->addValidation('lastname',"req","Please fill in Last Name");
	 $validator->addValidation('lastname',"maxlen=45","Last Name should not exceed 45 characters");
	 $validator->addValidation('email',"email","Invalid email address!");
	 $validator->addValidation('email',"req","Please fill in Email");
	 $validator->addValidation('email',"maxlen=50","Email should not exceed 50 characters");
	 $validator->addValidation('password',"req","Please fill in Password");
	 $validator->addValidation('password',"maxlen=12","Password should not exceed 12 characters");
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
					$mysql = 'SELECT COUNT(*) As NoRecords FROM customer WHERE email = :email';
					$a = $pdo->prepare($mysql);
					$a->bindValue(':email', $_POST['email']);
					$a->execute();
					$row = $a->fetch();
					$number_records = $row['NoRecords'];
					if($number_records>=1)
					{
						$error = 'Email address already in use!';
						include 'register.html.php';
					}
					else
					{
						$sql = 'INSERT INTO customer SET
						firstName = :firstname,
						lastName = :lastname,
						email = :email,
						passWord = md5(:password),
						address1 = :address1,
						address2 = :address2,
						suburb = :suburb,
						state = :state,
						postCode = :postcode,
						dateJoined = CURDATE()';

						$s = $pdo->prepare($sql);
						$s->bindValue(':firstname', $_POST['firstname']);
						$s->bindValue(':lastname', $_POST['lastname']);
						$s->bindValue(':email', $_POST['email']);
						$s->bindValue(':password', $_POST['password']);
						$s->bindValue(':address1', $_POST['address1']);
						$s->bindValue(':address2', $_POST['address2']);
						$s->bindValue(':suburb', $_POST['suburb']);
						$s->bindValue(':state', $state);
						$s->bindValue(':postcode', $_POST['postcode']);
						$s->execute();
					}
				}
				catch (PDOException $e)
				{
					$error = 'Error adding new customer.';
					include 'register.html.php';
				}
				header('Location: ../myaccount');
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
			include 'register.html.php';


    	}

}
else
{

	$error='';
	$firstname = '';
	$lastName = '';
	$email = '';
	$passWord = '';
	$address1 = '';
	$address2 = '';
	$suburb = '';
	$postcode = '';

	include 'register.html.php';
}

?>