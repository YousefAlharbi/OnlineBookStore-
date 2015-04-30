<?php
error_reporting(E_ERROR);
include '../../includes/db.inc.php';
include '../../includes/magicquotes.inc.php';
$pageTitle = 'Manage Products';
$error = '';
$action ='';

/*
	Author: Ahmed
	Date: 5-January-2015
	Description: Home page for when the user would like to manage products
	Special notes:
*/

try
{
	$result = $pdo->query('SELECT DISTINCT category FROM item');
}
catch (PDOException $e)
{
	$error = 'Error fetching categories from the database!';
	include '../error.html.php';
	exit();
}

foreach ($result as $row)
{
	$categories[] = $row[0];
}

if (isset($_GET['add']))
{
	$pageTitle = 'New Product';
	$action = 'addform';
	$itemCode = '';
	$itemName = '';
	$description = '';
	$category = '';
	$qtyOnHand = 0;
	$unitPrice = 0.00;
	$photo1 = '';
	$photo2 = '';
	$photo3 = '';
	$thumbNail = '';
	$featured = FALSE;
	$button = 'Add';

	include 'newproduct.html.php';
	exit();
}
else if (isset($_GET['addform']))
{
	 $pageTitle = 'Add Product';
	 $action = 'addform';
	 $button = 'Add Product';

	 $itemCode=$_POST['itemCode'];
	 $itemName=$_POST['itemName'];
	 $description =$_POST['description'];
	 $qtyOnHand=$_POST['qtyOnHand'];
	 $unitPrice=$_POST['unitPrice'];
	 $category=$_POST['category'];

	 if(isset($_POST['featured']) && $_POST['featured']=='featured')
	 {
		$featured = true;
 	 }
	 else
	 {
		$featured = false;
	 }

	 require_once "../../includes/formvalidator.inc.php";
	 $validator = new FormValidator();
     $validator->addValidation('itemCode',"req","Please fill in Item Code");
	 $validator->addValidation('itemCode',"maxlen=10","Item Code should not exceed 10 characters");
	 $validator->addValidation('itemCode',"alnum","Item Code should contain alphabets and numbers only without any spaces");
	 $validator->addValidation('itemName',"req","Please fill in Item Name");
	 $validator->addValidation('itemName',"maxlen=25","Item Name should not exceed 25 characters");
	 $validator->addValidation('description',"req","Please fill in Item description");
	 $validator->addValidation('description',"maxlen=255","Item Code should not exceed 255 characters");
	 $validator->addValidation('qtyOnHand',"req","Please fill in Item quantity on hand");
	 $validator->addValidation('qtyOnHand',"num","Item quantity should be a valid number");
	 $validator->addValidation('qtyOnHand',"gt=0","Item quantity should be a valid number");
	 $validator->addValidation('unitPrice',"req","Please fill in unit price");
	 //$validator->addValidation('unitPrice',"num","Unit Price should be a valid number");
	 //$validator->addValidation('unitPrice',"gt=-1","Unit Price should be a valid number");

	 $validation_errors="";

	 $photo1check = false;
	 $photo2check = false;
	 $photo3check = false;
	 $thumbNailcheck = false;

	 $imageName = 'photo1';
	 $imagecheck = false;
	 include 'photovalidate.php';
	 if($imagecheck==true)
	 {
	 	$photo1check = true;
	 }


	 if(isset($_FILES["photo2"]["name"]) && ($_FILES["photo2"]["name"]!=''))
	 {
	 	 $photo2Name = 	$_FILES["photo2"]["name"];
		 $imageName = 'photo2';
		 $imagecheck = false;
		 include 'photovalidate.php';
		 if($imagecheck==true)
		 {
			$photo2check = true;
		 }
	 }
	 else
	 {
	 	$photo2check = true;
	 	$photo2Name = NULL;
	 }


	 if(isset($_FILES["photo3"]["name"]) && ($_FILES["photo3"]["name"]!=''))
	 {
	 	 $photo3Name = 	$_FILES["photo3"]["name"];
		 $imageName = 'photo3';
		 $imagecheck = false;
		 include 'photovalidate.php';
		 if($imagecheck==true)
		 {
			$photo3check = true;
		 }
	 }
	 else
	 {
	 	 $photo3check = true;
	 	 $photo3Name = NULL;
	 }

	 $imageName = 'thumbNail';
	 $imagecheck = false;
	 include'photovalidate.php';
	 if($imagecheck==true)
	 {
	 	 $thumbNailcheck = true;
	 }




	    if($validator->ValidateForm() && ($photo1check == true) && ($photo2check == true) && ($photo3check == true) && ($thumbNailcheck == true))
	    {
	        try
				{
					$mysql = 'SELECT COUNT(*) As NoRecords FROM item WHERE itemCode = :itemCode';
					$a = $pdo->prepare($mysql);
					$a->bindValue(':itemCode', $_POST['itemCode']);
					$a->execute();
					$row = $a->fetch();
					$number_records = $row['NoRecords'];
					if($number_records>=1)
					{
						$error = 'Item Code already in use!';
						include 'newproduct.html.php';
						exit();
					}
					else
					{
						$sql = 'INSERT INTO item SET
						itemCode = :itemCode,
						itemName = :itemName,
						description = :description,
						category = :category,
						qtyOnHand = :qtyOnHand,
						unitPrice = :unitPrice,
						photo1 = :photo1,
						photo2 = :photo2,
						photo3 = :photo3,
						featured = :featured,
						thumbNail = :thumbNail';



						$s = $pdo->prepare($sql);
						$s->bindValue(':itemCode', $_POST['itemCode']);
						$s->bindValue(':itemName', $_POST['itemName']);
						$s->bindValue(':description', $_POST['description']);
						$s->bindValue(':category', $_POST['category']);
						$s->bindValue(':qtyOnHand', $_POST['qtyOnHand']);
						$s->bindValue(':unitPrice', $_POST['unitPrice']);
						$s->bindValue(':photo1', $_FILES["photo1"]["name"]);
						$s->bindValue(':photo2', $photo2Name);
						$s->bindValue(':photo3', $photo3Name);
						$s->bindValue(':featured', $featured);
						$s->bindValue(':thumbNail', $_FILES["thumbNail"]["name"]);
						$s->execute();
						move_uploaded_file($_FILES["photo1"]["tmp_name"],"../../images/" . $_FILES["photo1"]["name"]);
						 if(isset($_FILES["photo2"]["name"]) && ($_FILES["photo2"]["name"]!=''))
	 	                {
						move_uploaded_file($_FILES["photo2"]["tmp_name"],"../../images/" . $_FILES["photo2"]["name"]);
						}
						if(isset($_FILES["photo3"]["name"]) && ($_FILES["photo3"]["name"]!=''))
						{
						move_uploaded_file($_FILES["photo3"]["tmp_name"],"../../images/" . $_FILES["photo3"]["name"]);
						}
						move_uploaded_file($_FILES["thumbNail"]["tmp_name"],"../../images/" . $_FILES["thumbNail"]["name"]);
					}
				}
				catch (PDOException $e)
				{
					$error = 'Error adding new product.';
					include 'newproduct.html.php';
					exit();
				}
				header('Location:/assignment/admin/products/manageproducts.html.php');
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
			include 'newproduct.html.php';


    	}

}
else if (isset($_GET['edit']))
{
	$itemCode = $_GET['edit'];
	try
	{
		$sql = "SELECT * FROM item WHERE itemCode = '$itemCode'";
		$result = $pdo->query($sql);
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching item from item table!';
		$pageTitle = 'Error';
		include 'error.html.php';
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
	$pageTitle = 'Edit Product';
		foreach ($items as $item)
		{
		$itemCode = $item['itemCode'];
		$itemName = $item['itemName'];
		$description = $item['description'];
		$category = $item['category'];
		$qtyOnHand = $item['qtyOnHand'];
		$unitPrice = $item['unitPrice'];
		$photo1 = $item['photo1'];
		$photo2 = $item['photo2'];
		$photo3 = $item['photo3'];
		$thumbNail = $item['thumbNail'];
		$featured = $item['featured'];
		}
		$action = 'editform';
		$button = 'Edit';

		include 'newproduct.html.php';
		exit();
}
else if (isset($_GET['editform']))
{
	 $pageTitle = 'Edit Product';
	 $action = 'editform';
	 $button = 'Edit';

	 $itemCode=$_POST['itemCode'];
	 $itemName=$_POST['itemName'];
	 $description =$_POST['description'];
	 $qtyOnHand=$_POST['qtyOnHand'];
	 $unitPrice=$_POST['unitPrice'];
	 if($_POST['featured']=='featured')
	 {
		$featured = true;
 	 }
	 else
	 {
		$featured = false;
	 }

	 require_once "../../includes/formvalidator.inc.php";
	 $validator = new FormValidator();
     $validator->addValidation('itemCode',"req","Please fill in Item Code");
	 $validator->addValidation('itemCode',"maxlen=10","Item Code should not exceed 10 characters");
	 $validator->addValidation('itemCode',"alnum","Item Code should contain alphabets and numbers only without any spaces");
	 $validator->addValidation('itemName',"req","Please fill in Item Name");
	 $validator->addValidation('itemName',"maxlen=25","Item Name should not exceed 25 characters");
	 $validator->addValidation('description',"req","Please fill in Item description");
	 $validator->addValidation('description',"maxlen=255","Item Code should not exceed 255 characters");
	 $validator->addValidation('qtyOnHand',"req","Please fill in Item quantity on hand");
	 $validator->addValidation('qtyOnHand',"num","Item quantity should be a valid number");
	 $validator->addValidation('qtyOnHand',"gt=0","Item quantity should be a valid number");
	 $validator->addValidation('unitPrice',"req","Please fill in unit price");
	 //$validator->addValidation('unitPrice',"num","Unit Price should be a valid number");
	 //$validator->addValidation('unitPrice',"gt=-1","Unit Price should be a valid number");

	 $validation_errors="";

	    if($validator->ValidateForm())
	    {
	        try
				{

						$sql = 'UPDATE item SET
						itemName = :itemName,
						description = :description,
						category = :category,
						qtyOnHand = :qtyOnHand,
						unitPrice = :unitPrice,
						featured = :featured,
						thumbNail = :thumbNail
						WHERE itemCode = :itemCode';



						$s = $pdo->prepare($sql);
						$s->bindValue(':itemCode', $_POST['itemCode']);
						$s->bindValue(':itemName', $_POST['itemName']);
						$s->bindValue(':description', $_POST['description']);
						$s->bindValue(':category', $_POST['category']);
						$s->bindValue(':qtyOnHand', $_POST['qtyOnHand']);
						$s->bindValue(':unitPrice', $_POST['unitPrice']);

						$s->bindValue(':featured', $featured);
						$s->bindValue(':thumbNail', "testThumbNail");
						$s->execute();


				}
				catch (PDOException $e)
				{
					$error = 'Error updating product.';
					include 'newproduct.html.php';
					exit();
				}
				header('Location:/assignment/admin/products/manageproducts.html.php');
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
			include 'newproduct.html.php';


    	}

}
else if (isset($_GET['delete']))
{
	$itemCode = $_GET['delete'];
	try
		{
			$sql = "SELECT * FROM item WHERE itemCode = '$itemCode'";
			$result = $pdo->query($sql);
		}
		catch (PDOException $e)
		{
			$error = 'Error fetching item from item table!';
			$pageTitle = 'Error';
			include 'error.html.php';
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
			'photo2' => $row['photo2'],
			'photo3' => $row['photo3'],
			'thumbNail' => $row['thumbNail'],
			'featured' => $row['featured']);

		}

			foreach ($items as $item)
			{
			$itemCode = $item['itemCode'];
			$itemName = $item['itemName'];
			$description = $item['description'];
			$category = $item['category'];
			$qtyOnHand = $item['qtyOnHand'];
			$unitPrice = $item['unitPrice'];
			$photo1 = $item['photo1'];
			$photo2 = $item['photo2'];
			$photo3 = $item['photo3'];
			$thumbNail = $item['thumbNail'];
			$featured = $item['featured'];
			}

	unlink("../../images/".$photo1);
	unlink("../../images/".$photo2);
	unlink("../../images/".$photo3);
	unlink("../../images/".$thumbNail);
		try
		{
			$sql = 'DELETE FROM item WHERE itemCode = :itemCode';
			$s = $pdo->prepare($sql);
			$s->bindValue(':itemCode', $itemCode);
			$s->execute();
		}
		catch (PDOException $e)
		{
			$error = 'Error deleting item from item table!';
			$pageTitle = 'Error';
			include 'error.html.php';
			exit();
		}
		header('Location:/assignment/admin/products/manageproducts.html.php');
		exit();
}



else
{
try
	{
		$sql = 'SELECT * FROM item';
		$result = $pdo->query($sql);
	}
	catch (PDOException $e)
	{
		$error = 'Error fetching data from item table!';
		$pageTitle = 'Error';
		include 'manageproducts.html.php';
		exit();
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
}
include 'manageproducts.html.php';
exit();

}

?>