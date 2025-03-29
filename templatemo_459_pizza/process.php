<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve data from the form
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['message']); // Subject field
    $message = htmlspecialchars($_POST['textarea']); // Message field

    // Check if all fields are filled
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        // Additional email format validation
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Thank you, $name! We have received your message.<br>";
            echo "Email: $email<br>";
            echo "Subject: $subject<br>";
            echo "Message: $message<br>";
        } else {
            echo "Please provide a valid email address.";
        }
    } else {
        echo "Please fill in all fields.";
    }
}
?>