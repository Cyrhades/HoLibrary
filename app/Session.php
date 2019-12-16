<?php

namespace HO;

class Session 
{
	public function __construct()
	{	
		$bStatut = false;
	    if ( php_sapi_name() !== 'cli' ) {
	        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
	            $bStatut = (session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE);
	        } else {
	            $bStatut = (session_id() === '' ? FALSE : TRUE);
	        }
	    }
    
    	if ($bStatut === FALSE) session_start();
	}

	public function set($name, $value)
	{
		$_SESSION[$name] = $value;
	}

	public function get($name)
	{
		return $_SESSION[$name]??null;
	}

	
	public function delete($name)
	{
		unset($_SESSION[$name]);
	}
}