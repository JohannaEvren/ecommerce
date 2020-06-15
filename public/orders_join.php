<?php
// Fetch order data
try {
	$query = "
		SELECT * FROM 'orders'
		INNER JOIN users ON oders.user_id = users.id
		INNER JOIN order_items ON oders.id = oder_items.order_id
		WHERE orders.id = :id
	";

	$stmt = $dbconnect->prepare($query);
    $stmt->bindvalue(':id', $_GET['id']);
    $stmt->execute();
    $data = $stmt->fetchAll();
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
$orderData = $data[0];

//BÖRJA KOLLA FRÅN 27 minuter typ

?>