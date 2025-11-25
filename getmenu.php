<?php
header('Content-Type: application/json');
$menu = json_decode(file_get_contents('menu.json'), true);
echo json_encode($menu);
?>
