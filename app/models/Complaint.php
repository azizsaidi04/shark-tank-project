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
    public function addComplaint($title, $description, $complaintTopic) {
        $query = "INSERT INTO " . $this->table . " (title, description, topic) VALUES (:title, :description, :topic)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':topic', $complaintTopic);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Modifier une réclamation
    public function updateComplaint($id, $title, $description, $complaintTopic) {
        $query = "UPDATE " . $this->table . " SET title = :title, description = :description, topic = :topic WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':topic', $complaintTopic);

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
        try {
            // Démarrer une transaction
            $this->conn->beginTransaction();
    
            // 1. Ajouter la réponse
            $stmt = $this->conn->prepare("INSERT INTO responses (complaint_id, response_text) VALUES (?, ?)");
            $stmt->execute([$complaint_id, $response_text]);
    
            // 2. Mettre à jour le statut de la plainte
            $update = $this->conn->prepare("UPDATE complaints SET status = 'closed' WHERE id = ?");
            $update->execute([$complaint_id]);
    
            // Valider la transaction
            $this->conn->commit();
    
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            // En cas d'erreur, annuler la transaction
            $this->conn->rollBack();
            // Optionnel : journaliser ou afficher l'erreur
            return false;
        }
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

    public function getFilteredComplaints($filters) {
        $query = "SELECT * FROM complaints WHERE 1=1";
        $params = [];
    
        // Filtrer par statut
        if (!empty($filters['status'])) {
            $query .= " AND status = :status";
            $params[':status'] = $filters['status'];
        }
    
        // Filtrer par titre
        if (!empty($filters['title'])) {
            $query .= " AND title LIKE :title";
            $params[':title'] = '%' . $filters['title'] . '%';
        }
    
        // Filtrer par date
        if (!empty($filters['date_filter'])) {
            if ($filters['date_filter'] == 'today') {
                $query .= " AND DATE(created_at) = CURDATE()";
            } elseif ($filters['date_filter'] == 'last_week') {
                $query .= " AND created_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
            } elseif ($filters['date_filter'] == 'last_month') {
                $query .= " AND created_at >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";
            }
        }
    
        // Tri par date
        $sortOrder = strtoupper($filters['sort_order']) == 'ASC' ? 'ASC' : 'DESC';
        $query .= " ORDER BY created_at $sortOrder";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatistics() {
        $query = "
            SELECT 
                COUNT(*) AS total_complaints,
                SUM(status = 'open') AS open_complaints,
                SUM(status = 'closed') AS closed_complaints,
                DATE(created_at) AS date,
                COUNT(*) AS complaints_per_day
            FROM complaints
            GROUP BY DATE(created_at)
            ORDER BY DATE(created_at) DESC
            LIMIT 7
        ";
    
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function getComplaintsCountByTopic()
    {
        $stmt = $this->conn->query("SELECT topic, COUNT(*) as count FROM complaints GROUP BY topic");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getComplaintsCountByDate()
    {
        $stmt = $this->conn->query("SELECT DATE(created_at) as date, COUNT(*) as count FROM complaints GROUP BY DATE(created_at)");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}
?>
