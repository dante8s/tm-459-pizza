<?php
require_once __DIR__.'/../includes/auth.php';  // Include Admin class
require_once __DIR__.'/../classes/Contact.php';
require_once __DIR__.'/../config/database.php';

// Create Admin class object
$admin = new Admin();

// Call method to verify admin is logged in
$admin->checkAdmin();

$db = (new Database())->connect();
$contact = new Contact($db);

// Handle deletion
if (isset($_GET['delete'])) {
    $contact->delete($_GET['delete']);
    header('Location: contacts.php');
    exit;
}

// Get all contacts
$contacts = $contact->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Management</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <?php include 'partials/sidebar.php'; ?>
    
    <main class="admin-content">
        <div class="container-fluid">
            <h1 class="mt-4">Contact Management</h1>
            
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    All Messages
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($contacts as $item): ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td><?= htmlspecialchars($item['name']) ?></td>
                                    <td><?= htmlspecialchars($item['email']) ?></td>
                                    <td><?= htmlspecialchars($item['subject']) ?></td>
                                    <td><?= date('d.m.Y H:i', strtotime($item['created_at'])) ?></td>
                                    <td>
                                        <a href="view_contact.php?id=<?= $item['id'] ?>" class="btn btn-info btn-sm">View</a>
                                        <a href="contacts.php?delete=<?= $item['id'] ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Delete this message?')">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>