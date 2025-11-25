<?php
header('Content-Type: application/json');
$orders = json_decode(file_get_contents('orders.json'), true);
echo json_encode($orders);
?>
