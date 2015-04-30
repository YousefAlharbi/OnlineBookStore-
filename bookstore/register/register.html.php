<?php include_once '../includes/helpers.inc.php';
/*
	Author: Ahmed
	Date: 5 January 2015
	Description: Display the registration page to the user
	Special notes:
*/
if(!isset($pageTitle))
{
header('Location: /assignment/register/');
}
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
       <?php include_once '../includes/header.inc.php'; ?>
         <div class="center_content">
            <div class="left_content">
            <div class="error"><?php echo $error; ?></div>
               <div class="title"><span class="title_icon"><img src="../images/bullet1.gif" alt="" title="" /></span>Register</div>
                 <div class="feat_prod_box_details">
                  <div class="contact_form">
                     <div class="form_subtitle">Fields marked * are compulsory</div>
                     <form name="register" action="?addcustomer" method="post">
                     	<div class="form_row">
						<label class="contact"><strong>First Name:</strong></label>
						<input type="text" name="firstname" id="firstname" class="contact_input" value="<?php echo $firstname;?>" />
					 	</div>
					 	<div class="form_row">
						<label class="contact"><strong>*Last Name:</strong></label>
						<input type="text" name="lastname" id="lastname" class="contact_input" maxlength="45" value="<?php echo $lastName;?>"/>
                        </div>
                        <div class="form_row">
                           <label class="contact"><strong>*Email:</strong></label>
                           <input type="text" name="email" id="email" class="contact_input" maxlength="50" value="<?php echo $email;?>"/>
                        </div>
                        <div class="form_row">
                           <label class="contact"><strong>*Password:</strong></label>
                           <input type="password" name="password" id="password" class="contact_input" maxlength="12" value="<?php echo $password;?>"/>
                        </div>

                        <div class="form_row">
                           <label class="contact"><strong>*Address 1:</strong></label>
                           <input type="text" name="address1" id="address1" class="contact_input" maxlength="45" value="<?php echo $address1;?>"/>
                        </div>
                        <div class="form_row">
                           <label class="contact"><strong>Address 2:</strong></label>
                           <input type="text" name="address2" id="address2" class="contact_input" maxlength="45" value="<?php echo $address2;?>"/>
                        </div>
                        <div class="form_row">
                           <label class="contact"><strong>*Suburb:</strong></label>
                           <input type="text" name="suburb" id="suburb" class="contact_input" maxlength="45" value="<?php echo $suburb;?>"/>
                        </div>
                        <div class="form_row">
                           <label class="contact"><strong>*State:</strong></label>
                           <select name="state" id="state" >
                           <?php foreach ($states as $state1) {
                           	  if($state==$state1)
                           	  {
                           	  	$option="selected='selected'";
                           	  }
                           	  else {
                           	    $option="";
                           	  }
                           ?>
                              <option value="<?php echo $state1;?>" <?php echo $option;?>><?php htmlout($state1); ?></option>
                           <?php } ?>
                           </select>
                        </div>
                        <div class="form_row">
                           <label class="contact"><strong>*Postcode:</strong></label>
                           <input type="text" name="postcode" id="postcode" class="state_postcode" maxlength="4" value="<?php echo $postcode;?>"/>
                        </div>

                        <div class="form_row">
                           <input type="submit" class="register" value="register" />
                        </div>
                     </form>
                  </div>
               </div>
               <div class="clear"></div>
            </div>
            <!--end of left content-->
            <div class="right_content">
              <?php include_once '../includes/cartdisplay.inc.php'; ?>
               <div class="right_box">
                 <?php require_once '../includes/categories.inc.php'; ?>


            </div>
            <!--end of right content-->
            <div class="clear"></div>
         </div>
         <!--end of center content-->
         <?php include_once '../includes/footer.inc.php'; ?>
      </div>
    </body>
</html>