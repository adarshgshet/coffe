<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$email = trim($data['email']);
$pass = trim($data['pass']);

$users = json_decode(file_get_contents('users.json'), true);

foreach ($users as $u) {
    if ($u['email'] === $email && $u['pass'] === $pass) {
        echo json_encode(["status" => "success", "user" => $u]);
        exit;
    }
}

echo json_encode(["status" => "error", "msg" => "Invalid credentials"]);
?>
