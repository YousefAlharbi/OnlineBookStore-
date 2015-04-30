<?php
include_once 'db.inc.php';
include_once 'magicquotes.inc.php';

/*
	Author: Noha Salem
	Date: 25 Dec 14
	Description: Setup the data for the categories
	Special notes:
*/

try
{
	$result = $pdo->query('SELECT DISTINCT category FROM item');
}
catch (PDOException $e)
{
	$error = 'Error fetching categories from the database!';
	include '../books/error.html.php';
}

foreach ($result as $row)
{
	$categories[] = $row[0];
}

?>

<div class="title"><span class="title_icon"><img src="/assignment/images/bullet5.gif" alt="" title="" /></span>Categories</div>
<ul class="list">
<?php foreach ($categories as $category) { ?>
<li><a href="/assignment/books/?category=<?php htmlout($category); ?>"><?php htmlout($category); ?></a></li>
 <?php } ?>

</ul>
</div>