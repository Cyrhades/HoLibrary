<?php

define('ROOT_DIR', dirname(__DIR__));
define('VIEW', ROOT_DIR.'/templates');
define('VIEW_CACHE', VIEW.'/_cache');
define('VIEW_EXT', '.html');

/** /!\ ATTENTION /!\ 
 * Permet actuellement d'afficher les dumps uniquement si on est pas en production
 * et d'avoir le cache Twig uniquement en production
 */
const PRODUCTION = false;

/** /!\ ATTENTION /!\ 
 * 
 * PASSWORD_ARGON2I est disponible à partir de la version 7.2 de PHP
 * 
 * une fois mis en production l'algo ne doit pu être changé !
 * 
 * @see https://www.php.net/manual/fr/password.constants.php
 */
const PASSWORD_TYPE_HASH = PASSWORD_ARGON2I; 


/**
 * Acces MySql
 */
const MYSQL_DSN = 'mysql:host=127.0.0.1; dbname=lastday';
const MYSQL_USER = 'root';
const MYSQL_PASSWORD = '';