<?php

namespace HO;

/**
 * AbstractController
 * 
 * Abstraction des controllers, regroupe les méthodes 
 * communes aux différents Controller
 * 
 * @author LECOMTE Cyril <cyrhades76@gmail.com>
 * @since 2019-10-14
 * @package HO
 */
class AbstractController
{
    /**
     * @var string|null nom du template
     */
    protected $_view;

    /**
     * @var object Moteur de template
     */
    private $engine;

    /**
     * @param $view string|null
     */
    public function __construct($view = null) 
    {
        $this->_view = $view; 
        
        $this->engine = new \Twig\Environment(
            new \Twig\Loader\FilesystemLoader(VIEW.'/'), 
            [ 'cache' => VIEW_CACHE ]
        );
    }

    /**
     * Cette méthode peut recevoir la vue en 1er parametre et les 
     * variables en second ou uniquement les variables 
     * (sachant qu'il est possible de déclarée la vue dans les routes)
     * 
     * @param $var1 null|array|string : 
     *      - null, 
     *      - tableau de variables à transmettre au template 
     *      - le nom du template
     * @param $var2  null|array : 
     *      - null, 
     *      - tableau de variables à transmettre au template 
     * 
     * print le résultat de la génération du template
     */
    protected function render($var1 = null, $var2 = null) 
    {
        $view = $this->_view;
        $variables = [];

        if($var1 !== null) {
            if(is_array($var1) && $var2 == null) {
                $variables = $var1;
            }  
            elseif(is_string($var1)) {
                $view = $var1;
                if($var2 !== null && is_array($var2)) {
                    $variables = $var2;
                }
            }
        }

        if (!empty($view) && file_exists(VIEW.'/'.$view.VIEW_EXT)) {
            echo $this->engine->load($view.VIEW_EXT)->render($variables);
        } else {
            die('Erreur : vue inexistante');
        }
    }

    /**
     * Reponse au format json
     */
    protected function responseJson($data) 
    {
        echo json_encode($data);
        exit();
    }

    /**
     * Methode de redirectionhttp
     */
    protected function redirectToRoute($routeName, $params = [], $codeHttp = 301) 
    {
        header("Location: ".$routeName.(count($params) ? '?'.http_build_query($params):''), true, $codeHttp);
        exit();
    }
}