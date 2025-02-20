<?php

class Router
{
    private $controller;
    private $action;

    public function routes()
    {
        // On récupère le contrôleur et l'action depuis l'URL, avec des valeurs par défaut
        $this->controller = isset($_GET['controller']) ? $_GET['controller'] . 'Controller' : 'HomeController';
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'homeAction';

        // On inclut le fichier du contrôleur
        require_once '../Controllers/' . $this->controller . '.php';

        // On instancie le contrôleur
        $controller = new $this->controller();

        // On vérifie si la méthode existe dans le contrôleur
        if (method_exists($controller, $this->action)) {
            // On vérifie si l'action attend un paramètre 'id'
            if (isset($_GET['id'])) {
                $id = (int) $_GET['id']; // Sécurisation de l'ID
                $controller->{$this->action}($id); // Appel de l'action avec l'ID
            } else {
                $controller->{$this->action}(); // Appel sans paramètre
            }
        } else {
            $controller->error404(); // Gère le cas où la méthode n'existe pas
        }
    }
}
