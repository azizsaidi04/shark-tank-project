<?php
require_once '../app/core/Controller.php';
require_once '../app/models/Complaint.php';
require_once '../app/core/Database.php';

class ComplaintController extends Controller {

    public $complaintModel;
    private $db;

    public function __construct() {
        parent::__construct();
        $database = new Database();
        $this->db = $database->getInstance();
        $this->complaintModel = new Complaint($this->db);
    }

    // Afficher toutes les réclamations
    public function index() {
        // Récupérer toutes les réclamations depuis la base de données
        $complaints = $this->complaintModel->getAllComplaints();
        // Passer les réclamations à la vue
        $this->view('frontoffice/complaints_list', ['complaints' => $complaints]);
    }
    


    // Ajouter une réclamation
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);

            // Server-side validation to check if title exceeds 7 words
            $titleWords = explode(' ', $title);
            if (count($titleWords) > 7) {
                // If title exceeds 7 words, show an error message
                $error = "Le titre ne doit pas dépasser 7 mots.";
                // Pass the error to the view
                $this->view('frontoffice/add_complaint', ['error' => $error]);
                return; // Stop further processing
            }

            if ($this->complaintModel->addComplaint($title, $description)) {
                header('Location: ../public/index.php?action=index');
            } else {
                echo "Erreur lors de l'ajout de la réclamation.";
            }
        }
        $this->view('frontoffice/add_complaint');
    }

    // Modifier une réclamation
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = htmlspecialchars($_POST['title']);
            $description = htmlspecialchars($_POST['description']);

            // Server-side validation to check if title exceeds 7 words
            $titleWords = explode(' ', $title);
            if (count($titleWords) > 7) {
                // If title exceeds 7 words, show an error message
                $error = "Le titre ne doit pas dépasser 7 mots.";
                // Pass the error to the view
                $this->view('frontoffice/add_complaint', ['error' => $error]);
                return; // Stop further processing
            }
            
            
            if ($this->complaintModel->updateComplaint($id, $title, $description)) {
                header('Location: ../public/index.php?action=index');
            } else {
                echo "Erreur lors de la modification de la réclamation.";
            }
        }

        // Récupérer la réclamation par ID pour la pré-remplir dans le formulaire
        $complaint = $this->complaintModel->getComplaintById($id)->fetch();
        $this->view('frontoffice/edit_complaint', ['complaint' => $complaint]);
    }

    // Supprimer une réclamation
    public function delete($id) {
        if ($this->complaintModel->deleteComplaint($id)) {
            header('Location: ../public/index.php?action=index');
        } else {
            echo "Erreur lors de la suppression de la réclamation.";
        }
    }

    // Ajouter une réponse à une réclamation
    public function reply($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $response_text = htmlspecialchars($_POST['response_text']);


            // Split the response into words
            $responseWords = explode(' ', $response_text);
            $wordCount = count($responseWords);

            // Initialize an empty error array
            $errors = [];

            // Check if response has more than 3 words
            if ($wordCount <= 3) {
                $errors[] = "La réponse doit comporter plus de 3 mots.";
            }

            // Check if response starts with uppercase letter
            if (!preg_match('/^[A-Z]/', $response_text)) {
                $errors[] = "La réponse doit commencer par une majuscule.";
            }

            // Check if response ends with period
            if (!preg_match('/\.$/', $response_text)) {
                $errors[] = "La réponse doit se terminer par un point.";
            }

            // If there are errors, display them and return to the form
            if (!empty($errors)) {
                $this->view('backoffice/reply_complaint', ['errors' => $errors, 'complaint_id' => $id]);
                return;
            }


            // Ajouter la réponse à la réclamation
            if ($this->complaintModel->addResponse($id, $response_text)) {
                header('Location: index.php?action=index'); // Rediriger vers la liste des réclamations
            } else {
                echo "Erreur lors de l'ajout de la réponse.";
            }
        }

        // Récupérer la réclamation et la réponse pour la pré-remplir
        $complaint = $this->complaintModel->getComplaintById($id)->fetch();
        $this->view('backoffice/reply_complaint', ['complaint' => $complaint]);
    }

    
    // Modify a response
    public function modify_reply($id) {
        // Fetch the current reply by ID
        $response = $this->complaintModel->getResponseById($id)->fetch();

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $responseText = htmlspecialchars($_POST['response_text']);

            // Split the response into words
            $responseWords = explode(' ', $responseText);
            $wordCount = count($responseWords);

            // Initialize an empty error array
            $errors = [];

            // Check if response has more than 3 words
            if ($wordCount <= 3) {
                $errors[] = "La réponse doit comporter plus de 3 mots.";
            }

            // Check if response starts with uppercase letter
            if (!preg_match('/^[A-Z]/', $responseText)) {
                $errors[] = "La réponse doit commencer par une majuscule.";
            }

            // Check if response ends with period
            if (!preg_match('/\.$/', $responseText)) {
                $errors[] = "La réponse doit se terminer par un point.";
            }

            // If there are errors, display them and return to the form
            if (!empty($errors)) {
                $this->view('backoffice/reply_complaint', ['errors' => $errors, 'reply_id' => $id, 'reply' => $response]);
                return;
            }

            if ($this->complaintModel->updateResponse($id, $responseText)) {
                // Redirect to the complaint page after successful modification
                header('Location: index.php?action=index&id=' . $response['complaint_id']);
            } else {
                echo "Error updating response.";
            }
        }

        $this->view('backoffice/reply_complaint', ['reply' => $response]);
    }

    // Delete a response
    public function delete_reply($id) {
        // Fetch the response to get the complaint ID
        $response = $this->complaintModel->getResponseById($id)->fetch();
        
        if ($this->complaintModel->deleteResponse($id)) {
            // Redirect to the complaint page after successful deletion
            header('Location: index.php?action=index&id=' . $response['complaint_id']);
        } else {
            echo "Error deleting response.";
        }
    }


}
?>
