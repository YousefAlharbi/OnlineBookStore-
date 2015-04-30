<?php
session_start();
session_destroy();
header('Location: index.php?logout=true');
exit();

/*
	Author: Yousef
	Date: 10 Jan 15
	Description: Administrator login page
	Special notes:
*/

?>

