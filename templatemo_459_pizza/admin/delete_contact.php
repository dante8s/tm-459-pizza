<?php
require_once __DIR__.'/../config/database.php';
require_once __DIR__.'/../classes/Contact.php';
require_once __DIR__.'/../includes/auth.php';

class ContactController {
    private $contact;
    private $auth;

    public function __construct() {
        $this->auth = new Auth();
        $this->auth->checkAdmin();
        
        $db = (new Database())->connect();
        $this->contact = new Contact($db);
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $this->validateCsrfToken()) {
            $this->deleteContact();
        }
        
        $this->redirect();
    }

    private function validateCsrfToken(): bool {
        return isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token'];
    }

    private function deleteContact() {
        $id = (int)($_POST['id'] ?? 0);
        
        try {
            $this->contact->delete($id);
            $_SESSION['success'] = "Contact deleted successfully";
        } catch (PDOException $e) {
            error_log("Deletion error: " . $e->getMessage());
            $_SESSION['error'] = "Error deleting contact";
        }
    }

    private function redirect() {
        header('Location: contacts.php');
        exit;
    }
}

// Instantiate and run the controller
$controller = new ContactController();
$controller->handleRequest();