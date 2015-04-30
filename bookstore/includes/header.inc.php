<?php
@session_start();

/*
	Author: Ahmed
	Date: 25 Dec 14
	Description: Page header
	Special notes:
*/
?>
<div class="header">
	<div class="logo"><a href="/assignment/"><img src="/assignment/images/logo.png" alt="" title="" border="0" /></a></div>
	<div id="menu">
	   <ul>
	    <?php
	   if(isset($_SESSION['adminloggedin'])&& ($_SESSION['name']!= NULL)) { ?>

		<li><a href="/assignment/admin/">Home</a></li>
		<li><a href="/assignment/admin/logout.php">Logout</a></li>
	   </ul>
	    <p> <?php htmlout($_SESSION['name']) ?> </p>
	   <?php
	   }
	   else
	   {
	   ?>
		  <li><a href="/assignment/index.php">Home</a></li>
		  <li><a href="/assignment/about/">About us</a></li>
		  <li><a href="/assignment/books/">Books</a></li>
		  <li><a href="/assignment/myaccount/">My Account</a></li>
		  <li><a href="/assignment/contact/">Contact</a></li>
		  <?php
		  if(isset($_SESSION['loggedin'])&& ($_SESSION['name']!= NULL)) { ?>
		  <li><a href="/assignment/myaccount/logout.php">Logout</a></li>
		  </ul>

		  <p> <?php htmlout($_SESSION['name']) ?> </p>
		  <?php } else{?>
		  <li><a href="/assignment/register/">Register</a></li>
		  </ul>
		  <?php }
		  }?>
	</div>
 </div>