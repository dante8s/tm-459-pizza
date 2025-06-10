<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <h3>Admin Panel</h3>
    </div>
    <ul class="sidebar-nav">
        <li class="<?= $current_page === 'contacts.php' ? 'active' : '' ?>">
            <a href="contacts.php"><i class="fas fa-envelope"></i> Contacts</a>
        </li>
        <li>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
</aside>