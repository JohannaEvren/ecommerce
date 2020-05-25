<!DOCTYPE html>
<html>
<head>
	<title>Shop</title>
</head>
<body>
	<h1>Shop page</h1>

	<a href="admin/adminProduct.php">ADMIN PRODUCTS</a>
	<a href="admin/adminUsers.php">ADMIN USERS</a>
    <form action="mypages.php" method="GET">
		<input type="hidden" name="userId" value="<?=$user['id']?>">
		<input type="submit" name="tomypagesBtn" value="my pages">
	</form>   
</body>
</html>
