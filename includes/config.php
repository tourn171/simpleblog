<?php 
ob_start();
session_start();

// Database configuration
define('DBHOST',"127.0.0.1");
define('DBUSER', 'tourn171');
define('DBPASS','');
define('DBNAME','c9');

$db = new PDO("mysql:host=".DBHOST.";port=3306;dbname=".DBNAME,DBUSER,DBPASS);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


// Set default timezone
date_default_timezone_set('Europe/London');

function __autoload($class){
    $class = strtolower($class);
    
    $classpath = 'classes/class.'.$class.'.php';
    if(file_exists($classpath)){
        require_once($classpath);
    }
    
    $classpath = '../classes/class.'.$class.'.php';
    if(file_exists($classpath)){
        require_once($classpath);
    }
}
$user = new USER($db);
?>