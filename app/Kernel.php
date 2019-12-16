<?php

namespace HO;

class Kernel
{
    /**
     * @var Router router
     */
    private $router;

    public function __construct()
    {
        // chargement des routes
        $this->router = new Router();
        $this->router->load(dirname(__DIR__).'/config/routes.php');
    }

    public function run()
    {
        // on envoi au routeur l'url courante
        $this->router->go($_SERVER['REQUEST_URI'],'/');
    }
}