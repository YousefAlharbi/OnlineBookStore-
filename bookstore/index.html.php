<?php include_once 'includes/helpers.inc.php';

/*
	Author: Ahmed Alshamisi
	Date: 9 December 2014
	Description: Display the home page for on line books 
	Special notes:
*/

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title><?php htmlout($pageTitle); ?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" />

</head>
<body>
<div id="wrap">

     <?php include_once 'includes/header.inc.php'; ?>

       <div class="center_content">
       	<div class="left_content">

            <div class="title"><span class="title_icon"><img src="images/bullet1.gif" alt="" title="" /></span>Featured Books</div>

			<?php if (isset($items)): ?>
        	<?php foreach ($items as $item): ?>

        	<div class="feat_prod_box">

            	<div class="prod_img"><a href="books/details.html.php?itemCode=<?php echo $item['itemCode'];?>"><img src="images/<?php echo $item['thumbNail'];?>" alt="" title="" border="0" width="66" height="100"/></a></div>

                <div class="prod_det_box">
                	<div class="box_top"></div>
                    <div class="box_center">
                    <div class="prod_title"><strong><?php echo $item['itemName'];?></strong></div>
                    <p class="details"><?php echo $item['description'];?></p>
                    <a href="books/details.html.php?itemCode=<?php echo $item['itemCode'];?>" class="more">- more details -</a>
                    <div class="clear"></div>
                    </div>

                    <div class="box_bottom"></div>
                </div>
            <div class="clear"></div>
            </div>
			<?php endforeach; ?>

			<?php endif; ?>






        </div><!--end of left content-->
         <div class="right_content">

		                 <?php include_once 'includes/cartdisplay.inc.php'; ?>

      <div class="right_box">
				<?php include_once '/includes/categories.inc.php'; ?>
		</div><!--end of right content-->

       <div class="clear"></div>
       </div><!--end of center content-->


      <?php include_once 'includes/footer.inc.php'; ?>


</div>

</body>
</html>