<?php
// classes/OrderHandler.php

class OrderHandler
{
    private $db;
    private $order;

    public function __construct($db)
    {
        $this->db = $db;
        $this->order = new Order($db);
    }

    public function handle(array $post): void
    {
        session_start();

        $name = trim($post['name'] ?? '');
        $phone = trim($post['phone'] ?? '');
        $address = trim($post['address'] ?? '');
        $pizzas = $post['pizza'] ?? [];

        $errors = [];

        if ($name === '') $errors[] = 'Please enter your name.';
        if ($phone === '') $errors[] = 'Please enter your phone number.';
        if ($address === '') $errors[] = 'Please enter your delivery address.';

        $orders = [];
        foreach ($pizzas as $pizzaName => $details) {
            if (isset($details['selected'])) {
                $qty = (int)($details['quantity'] ?? 0);
                if ($qty < 1) {
                    $errors[] = "Quantity for pizza \"{$pizzaName}\" must be at least 1.";
                } else {
                    $orders[$pizzaName] = $qty;
                }
            }
        }

        if (empty($orders)) {
            $errors[] = 'Please select at least one pizza with quantity.';
        }

        if (!empty($errors)) {
            $_SESSION['order_errors'] = $errors;
            $_SESSION['order_data'] = $post;
            $this->redirectBack();
        }

        $allSuccess = true;
        foreach ($orders as $pizzaName => $qty) {
            $success = $this->order->create($name, $phone, $address, $pizzaName, $qty);
            if (!$success) {
                $allSuccess = false;
                break;
            }
        }

        if ($allSuccess) {
            $_SESSION['order_success'] = 'Thank you for your order!';
            unset($_SESSION['order_data']);
        } else {
            $_SESSION['order_errors'] = ['Failed to save the order. Please try again later.'];
            $_SESSION['order_data'] = $post;
        }

        $this->redirectBack();
    }

    private function redirectBack(): void
    {
        header('Location: http://localhost/tm-459-pizza/templatemo_459_pizza/#order');
        exit;
    }
}