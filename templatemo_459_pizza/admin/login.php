<?php
require_once __DIR__.'/../includes/auth.php';  
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
  
    $admin = new Admin();

    if ($admin->adminLogin($username, $password)) {
        header('Location: contacts.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}

$homeUrl = 'http://localhost/tm-459-pizza/templatemo_459_pizza/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
 
</head>
<body>
    <div class="container">
        <div class="login-container">
            
            <a href="<?= $homeUrl ?>" class="home-btn" title="Go to Home">
                <i class="fas fa-home fa-lg"></i>
            </a>

            <h2 class="text-center mb-4">Admin Login</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
