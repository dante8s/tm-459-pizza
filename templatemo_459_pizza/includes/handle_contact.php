<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    require_once __DIR__ . '/../config/database.php';
    require_once __DIR__ . '/../classes/Contact.php';
    require_once __DIR__ . '/../classes/ContactHandler.php';

    $db = (new Database())->connect();
    $handler = new ContactHandler($db);
    $handler->handle($_POST);
}
