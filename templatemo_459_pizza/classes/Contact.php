<?php
class Contact {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Додати новий контакт (приймає масив даних)
    public function create(array $data) {
        $name = $data['name'] ?? '';
        $email = $data['email'] ?? '';
        $subject = $data['subject'] ?? '';
        $message = $data['message'] ?? '';

        $query = "INSERT INTO contacts (name, email, subject, message) 
                  VALUES (:name, :email, :subject, :message)";
        
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);

        return $stmt->execute();
    }

    // Отримати всі контакти
    public function getAll() {
        $query = "SELECT * FROM contacts ORDER BY created_at DESC";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Отримати один контакт по ID
    public function getById($id) {
        $query = "SELECT * FROM contacts WHERE id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Видалити контакт
    public function delete($id) {
        $query = "DELETE FROM contacts WHERE id = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>
 