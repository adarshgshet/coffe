<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

$name = trim($data['name']);
$email = trim($data['email']);
$pass = trim($data['pass']);

if (!$name || !$email || !$pass) {
    echo json_encode(["status" => "error", "msg" => "All fields are required."]);
    exit;
}

// Password validation: lowercase, digit, special char
if (!preg_match('/^(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]).{6,}$/', $pass)) {
    echo json_encode(["status" => "error", "msg" => "Password must contain lowercase, digit, and special character."]);
    exit;
}

$users = json_decode(file_get_contents('users.json'), true);

// Check if email exists
foreach ($users as $u) {
    if ($u['email'] === $email) {
        echo json_encode(["status" => "error", "msg" => "Email already registered."]);
        exit;
    }
}

$users[] = ["name"=>$name, "email"=>$email, "pass"=>$pass];
file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));

echo json_encode(["status"=>"success", "msg"=>"Registered successfully!"]);
?>
