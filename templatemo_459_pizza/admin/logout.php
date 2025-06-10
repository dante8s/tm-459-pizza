<?php
require_once __DIR__.'/../includes/auth.php';

class SessionManager {
    public function logout(): void {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset(); 
            session_destroy();
            header('Location: login.php'); 
            exit;
        }
    }
}


$session = new SessionManager();
$session->logout();