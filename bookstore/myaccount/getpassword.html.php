<?php
include_once '../includes/helpers.inc.php';
if(!isset($pageTitle))
{
header('Location: /assignment/myaccount/');
}
@session_start();
if(isset($_SESSION['loggedin']))
{
	header('Location: /assignment/myaccount/');
	exit();
}

/*
	Author: Faisal 
	Date: 5 January 2015
	Description: Retrieve a password
	Special notes:
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title><?php htmlout($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
<div id="wrap">
		<?php
			if(isset($_GET['logout']))
			{
				$error="You have been logged out successfully";
			}
		?>
       <?php include_once '../includes/header.inc.php'; ?>

       <div class="center_content">
       	<div class="left_content">
       	<div class="error">
       	<?php
       		if(isset($success) && $success!='')
       		{
				echo $success;
       		}
       		else if(isset($error) && $error!='')
       		{
				echo $error;
       		}
       	?>
       	</div>
            <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Retrieve Forgotten Password</div>

        	<div class="feat_prod_box_details">

              	<div class="contact_form">
                <div class="form_subtitle">Retrieve forgotten password</div>
                 <form name="login" action="?getpasswordsubmit" method="post">
                    <div class="form_row">
                    <label class="contact"><strong>* Email:</strong></label>
                    <input type="text" name="email" id="email" class="contact_input" maxlength="50"/>
                    </div>

                    <div class="form_row">
                    <input type="submit" class="register" value="show" />
                    </div>

                  </form>

                </div>

            </div>






        <div class="clear"></div>
        </div><!--end of left content-->
         <div class="right_content">
 		<?php include_once '../includes/cartdisplay.inc.php'; ?>

       <div class="right_box">
				<?php require_once '../includes/categories.inc.php'; ?>
	</div><!--end of right content-->




       <div class="clear"></div>
       </div><!--end of center content-->


      <?php include_once '../includes/footer.inc.php'; ?>

</div>

</body>
</html>