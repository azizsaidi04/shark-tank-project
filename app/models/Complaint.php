<?php
class Complaint {
    private $conn;
    private $table = 'complaints';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllComplaints()
    {
        // Récupérer toutes les réclamations
        $query = "SELECT * FROM complaints ORDER BY created_at DESC"; // Tri par date
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(); // Retourne toutes les réclamations sous forme de tableau
    }


    // Ajouter une réclamation
    public function addComplaint($title, $description) {
        $query = "INSERT INTO " . $this->table . " (title, description) VALUES (:title, :description)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Modifier une réclamation
    public function updateComplaint($id, $title, $description) {
        $query = "UPDATE " . $this->table . " SET title = :title, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Supprimer une réclamation
    public function deleteComplaint($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Obtenir toutes les réclamations d'un utilisateur
    public function getComplaintsByUser($user_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt;
    }

    // Obtenir une réclamation par ID
    public function getComplaintById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    public function addResponse($complaint_id, $response_text) {
        $stmt = $this->conn->prepare("INSERT INTO responses (complaint_id, response_text) VALUES (?, ?)");
        $stmt->execute([$complaint_id, $response_text]);
        return $stmt->rowCount() > 0; // Retourne true si la réponse a été ajoutée
    }
    
    public function getResponsesByComplaintId($complaint_id) {
        $stmt = $this->conn->prepare("SELECT * FROM responses WHERE complaint_id = ?");
        $stmt->execute([$complaint_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getResponseById($id) {
        $query = "SELECT * FROM responses WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt;
    }

    // Method to update a response
    public function updateResponse($id, $responseText) {
        $stmt = $this->conn->prepare("UPDATE responses SET response_text = :response_text WHERE id = :id");
        return $stmt->execute(['id' => $id, 'response_text' => $responseText]);
    }

    // Method to delete a response
    public function deleteResponse($id) {
        $stmt = $this->conn->prepare("DELETE FROM responses WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    
}
?>
