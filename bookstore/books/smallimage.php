<?php
	/*
		Author: Faisal Bin Ghimlas
		Date: 12-January-2015
		Description: Render the image. This page does not have any html output, instead it just produces an image from the database
		Special notes:
	*/

   header('Content-Type: image/jpeg');
   $imagename=$_GET['imagename'];
   include('../includes/SimpleImage.php');
   $image = new SimpleImage();
   $image->load('../images/'.$imagename);
   $image->resizeToHeight(385);
   $image->resizeToWidth(250);
   $image->output();
?>