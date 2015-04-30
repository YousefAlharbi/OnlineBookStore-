<?php

/*
	Author: Noha
	Date: 9-January-2015
	Description: Validate that the photo is right extension and right size etc
	Special notes:
*/

 $allowedExts = array("gif", "jpeg", "jpg", "png");
 $extension = end(explode(".", $_FILES[$imageName]["name"]));
	 if ((($_FILES[$imageName]["type"] == "image/gif")
	 || ($_FILES[$imageName]["type"] == "image/jpeg")
	 || ($_FILES[$imageName]["type"] == "image/jpg")
	 || ($_FILES[$imageName]["type"] == "image/png"))
	 && ($_FILES[$imageName]["size"] < 2000000)
	 && in_array($extension, $allowedExts))
	   {
	   if ($_FILES[$imageName]["error"] > 0)
	     {
	     $error.= $_FILES[$imageName]["error"] . "<br>";
	     }
	   else
	     {


	     if (file_exists("../../images/" . $_FILES[$imageName]["name"]))
	       {
	       $error.= $_FILES[$imageName]["name"] . " already exists.<br>";
	       }
	     else
	       {
	       $imagecheck = true;

	       }
	     }
	   }
	 else
	   {
	   $error.= $imageName." is an invalid file <br/>";
  		}
?>