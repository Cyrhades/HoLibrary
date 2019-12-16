<?php

// le systeme de chargement des classes (autoload)
require dirname(__DIR__).'/vendor/autoload.php';

// chargement des constantes 
require dirname(__DIR__).'/config/constantes.php';

if (PRODUCTION !== true) {
    HO\Debug::deleteCache();
}


// Démarrage du Kernel
(new HO\Kernel())->run();