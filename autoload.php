<?php
spl_autoload_register(function ($className) {
    $className = str_replace("\\", "/", $className);
	// className = Controller\HomeController
	
	
	require_once($className.".php");
});
?>