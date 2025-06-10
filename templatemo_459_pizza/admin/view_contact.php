<?php
require_once __DIR__.'/../includes/auth.php';
require_once __DIR__.'/../classes/Contact.php';
require_once __DIR__.'/../config/database.php';

class ContactController {
    private Admin $admin;
    private Contact $contact;
    
    public function __construct() {
        $this->admin = new Admin();
        $this->admin->checkAdmin();
        
        $db = (new Database())->connect();
        $this->contact = new Contact($db);
    }
    
    public function viewContact(): void {
        $contactId = $_GET['id'] ?? 0;
        $contactData = $this->contact->getById($contactId);

        if (!$contactData) {
            header('Location: contacts.php');
            exit;
        }

        $this->renderView($contactData);
    }

    private function renderView(array $contactData): void {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>View Message #<?= htmlspecialchars($contactData['id']) ?></title>
            <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="../assets/css/admin.css">
        </head>
        <body class="admin-body">
            <?php include 'partials/sidebar.php'; ?>
            <main class="admin-content">
                <div class="container-fluid">
                    <h1 class="mt-4">Message from <?= htmlspecialchars($contactData['name']) ?></h1>
                    
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Email:</strong> <?= htmlspecialchars($contactData['email']) ?>
                            </div>
                            <div class="mb-3">
                                <strong>Subject:</strong> <?= htmlspecialchars($contactData['subject']) ?>
                            </div>
                            <div class="mb-3">
                                <strong>Date:</strong> <?= date('d.m.Y H:i', strtotime($contactData['created_at'])) ?>
                            </div>
                            <div class="mb-3">
                                <strong>Message:</strong>
                                <div class="p-3 bg-light rounded">
                                    <?= nl2br(htmlspecialchars($contactData['message'])) ?>
                                </div>
                            </div>
                            
                            <a href="contacts.php" class="btn btn-secondary">Back to list</a>
                        </div>
                    </div>
                </div>
            </main>
        </body>
        </html>
        <?php
    }
}


$controller = new ContactController();
$controller->viewContact();