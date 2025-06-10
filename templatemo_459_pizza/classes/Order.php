<?php
class Order {
    private $conn;

    
    public function __construct($db) {
        $this->conn = $db;
    }

    
    public function create($name, $phone, $address, $pizza_type, $quantity) {
        $sql = "INSERT INTO orders (name, phone, address, pizza_type, quantity, created_at)
                VALUES (:name, :phone, :address, :pizza_type, :quantity, NOW())";

        $stmt = $this->conn->prepare($sql);

        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':pizza_type', $pizza_type);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

      
        return $stmt->execute();
    }
}
?>
