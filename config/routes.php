<?php
/*
 * Table des routes de l'application.
 *
 * Pour chaque nom de route listé il y a un contrôleur et éventuellement une vue associés.
 * La route '_home' est utilisée quand aucune route n'est spécifiée dans l'URL.
 */
return [
    '/' =>
    [
        'controller' => 'Home',
        'methods'    => ['GET' => 'print'],
        'view'       => 'web/home'
    ]
];