<?php
require('../src/config.php');
require('../src/dbconnect.php'); 

?>
<!DOCTYPE html>
<html>
<head>
	<title>homepage</title>
</head>
<body>
	<h1>Shop page</h1>
	<form action="mypages.php" method="GET">
		<input type="hidden" name="userId" value="<?=$user['id']?>">
		<input type="submit" name="tomypagesBtn" value="my pages">
	</form>   
</body>
</html>
