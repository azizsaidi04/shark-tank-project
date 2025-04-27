<?php
class Controller {

    public function __construct()
    {
        // Rien pour l'instant
    }

    protected function view($view, $data = []) {
        extract($data);
        // require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/' . $view . '.php';
    }
}
?>
