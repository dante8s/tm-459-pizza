<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__.'/../config/database.php';

class Admin {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function checkAdmin() {
        if (!isset($_SESSION['admin_logged_in'])) {
            header('Location: login.php');
            exit;
        }
    }

    public function adminLogin($username, $password) {
        try {
            $stmt = $this->db->prepare("SELECT id, password FROM admins WHERE username = ?");
            $stmt->execute([$username]);
            
            if ($stmt->rowCount() === 1) {
                $admin = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $admin['password'])) {
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_id'] = $admin['id'];
                    return true;
                }
            }
            return false;
        } catch(PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            return false;
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        
        header('Location: login.php');
        exit;
    }

    
}
?>