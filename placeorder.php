<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$name = trim($data['name']);
$phone = trim($data['phone']);
$cart = $data['cart'];

if (!$name || !preg_match('/^\d{10}$/', $phone) || empty($cart)) {
    echo json_encode(["status"=>"error", "msg"=>"Invalid input"]);
    exit;
}

$orders = json_decode(file_get_contents('orders.json'), true);
$orders[] = ["name"=>$name,"phone"=>$phone,"cart"=>$cart,"time"=>date("Y-m-d H:i:s")];
file_put_contents('orders.json', json_encode($orders, JSON_PRETTY_PRINT));

echo json_encode(["status"=>"success", "msg"=>"Order submitted!"]);
?>
