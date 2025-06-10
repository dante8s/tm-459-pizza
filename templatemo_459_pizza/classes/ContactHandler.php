<?php
class ContactHandler
{
    private $db;
    private $contact;

    public function __construct($db)
    {
        $this->db = $db;
        $this->contact = new Contact($db);
    }

    public function handle(array $post): void
    {
        session_start();

        $name = trim($post['name'] ?? '');
        $email = trim($post['email'] ?? '');
        $subject = trim($post['subject'] ?? '');
        $message = trim($post['message'] ?? '');

        $errors = [];

        if ($name === '') $errors[] = 'Please enter your name.';
        if ($email === '') $errors[] = 'Please enter your email address.';
        if ($message === '') $errors[] = 'Please enter a message.';

        if (!empty($errors)) {
            $_SESSION['contact_errors'] = $errors;
            $_SESSION['contact_data'] = $post;
            $this->redirectBack();
        }

        $success = $this->contact->create([
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message
        ]);

        if ($success) {
            $_SESSION['contact_success'] = 'Thank you! Your message has been sent.';
            unset($_SESSION['contact_data']);
        } else {
            $_SESSION['contact_errors'] = ['An error occurred while sending your message. Please try again later.'];
            $_SESSION['contact_data'] = $post;
        }

        $this->redirectBack();
    }

    private function redirectBack(): void
    {
        header('Location: http://localhost/tm-459-pizza/templatemo_459_pizza/#contact');
        exit;
    }
}
