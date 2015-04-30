<?php
include_once '../includes/helpers.inc.php';
if(!isset($pageTitle))
{
header('Location: /assignment/admin/');
}
@session_start();
if(isset($_SESSION['adminloggedin']))
{
	header('Location: /assignment/admin/');
	exit();
}

/*
	Author: Yousef
	Date: 8 Jan 15
	Description: Login form for the administrator
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
       <div class="header">
	<div class="logo"><a href="/assignment/"><img src="/assignment/images/logo.png" alt="" title="" border="0" /></a></div>
		</div>
       <div class="center_content">
       	<div class="left_content">
       	<div class="error"><?php echo $error; ?></div>
            <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Login</div>

        	<div class="feat_prod_box_details">

              	<div class="contact_form">
                <div class="form_subtitle">Login into your account</div>
                 <form name="login" action="?loginadmin" method="post">
                    <div class="form_row">
                    <label class="contact"><strong>Admin ID:</strong></label>
                    <input type="text" name="adminId" id="adminId" class="contact_input" maxlength="50"/>
                    </div>


                    <div class="form_row">
                    <label class="contact"><strong>Password:</strong></label>
                    <input type="password" name="password" id="password" class="contact_input" maxlength="12" />
                    </div>

                    <div class="form_row">
                    <input type="submit" class="register" value="login" />
                    </div>

                  </form>

                </div>

            </div>






        <div class="clear"></div>
        </div><!--end of left content-->
         <div class="right_content">




	</div><!--end of right content-->




       <div class="clear"></div>
       </div><!--end of center content-->


<div class="footer">
    <div class="left_footer">&copy; Books "R" Us</div>
    <div class="right_footer">
    </div>
</div>

</div>

</body>
</html>