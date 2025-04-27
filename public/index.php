<?php
require_once '../app/controllers/ComplaintController.php';

$controller = new ComplaintController();
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;  // Récupérer l'ID si présent

if (method_exists($controller, $action)) {
    // Passer l'ID à la méthode si l'action est 'edit'
    if ($action === 'edit' && $id !== null) {
        $controller->$action($id);
    } else if ($action === 'delete' && $id !== null) {
        $controller->$action($id);
    } else if ($action === 'reply' && $id !== null) {
        $controller->$action($id);
    } else if ($action === 'modify_reply' && $id !== null) {
        $controller->$action($id);
    } else if ($action === 'delete_reply' && $id !== null) {
        $controller->$action($id);
    } else {
        $controller->$action();
    }
} else {
    echo "Page non trouvée.";
}
?>
