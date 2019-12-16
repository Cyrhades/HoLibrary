<?php

namespace HO;

class Router
{
    /**
     * @var array contient la liste des routes
     */
    private $routes;

    /**
     * @var string l'url courante
     */
    private $currentUrl;


    public function __construct()
    {
        $this->routes = [];
    }

    /**
     * Chargement du fichier de routes
     */
    public function load($fileRoutes)
    {
        if (file_exists($fileRoutes)) {
            $this->routes = include $fileRoutes;
        } else {
            throw new Exception('Le fichier "/config/routes.php" n\'existe pas !');
        }
    }
    
    public function go($url)
    {
        $this->currentUrl = trim($url, '/');
        if (($uri = stristr($this->currentUrl, '?', true)) !== false) {
            $this->currentUrl = $uri;
        }
        if($this->currentUrl === '') $this->currentUrl = '/';
        
        if (array_key_exists($this->currentUrl, $this->routes)) {
            
            //Debug::dump($_SERVER['REQUEST_METHOD'], false);
            // Si il manque la clef controller dans la route
            if (!array_key_exists('controller', $this->routes[$this->currentUrl])) {
                throw new Exception('Il faut obligatoirement la clef "controller" dans la route');
            }
            // Si il manque la clef methods dans la route
            if (!array_key_exists('methods', $this->routes[$this->currentUrl])) {
                throw new Exception('Il faut obligatoirement la clef "methods" dans la route');
            }

  
            $controller = 'Game\\Controller\\'.$this->routes[$this->currentUrl]['controller'];
            $view = $this->routes[$this->currentUrl]['view']??'';

            // si methods est un tableau
            if(is_array($this->routes[$this->currentUrl]['methods']))
            {
                // si la methode existe on appel la methode pour cette methode
                if(array_key_exists($_SERVER['REQUEST_METHOD'], $this->routes[$this->currentUrl]['methods'])) {
                    $methode = $this->routes[$this->currentUrl]['methods'][$_SERVER['REQUEST_METHOD']];
                } else {
                    // erreur 405 : Method Not Allowed
                    $controller = '\App\ErrorController';
                    $methode = 'error405';
                }
            } elseif (is_string($this->routes[$this->currentUrl]['methods'])) {
                $methode = $this->routes[$this->currentUrl]['methods'];
            }
            
            
        } else {
            // erreur 404 : Not Found
            $controller = '\App\ErrorController';
            $methode = 'error404';
        }

        try {
            call_user_func([new $controller($view??''),$methode]);
        } catch(Exception $e) {
            call_user_func([new \App\ErrorController,'exception'], $e->getMessage());
        }
    }
}