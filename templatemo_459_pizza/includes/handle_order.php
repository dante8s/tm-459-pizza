<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_submit'])) {
    require_once __DIR__ . '/../config/database.php';
    require_once __DIR__ . '/../classes/Order.php';
    require_once __DIR__ . '/../classes/OrderHandler.php';

    $db = (new Database())->connect();
    $handler = new OrderHandler($db);
    $handler->handle($_POST);
}
