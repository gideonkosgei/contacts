<?php

// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)

//defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
//echo DIRECTORY_SEPARATOR;
$os = PHP_OS;
switch($os)
{
    case "Linux": define("DS", "/"); break;
    case "Windows": define("DS", "\\"); break;
	case "WINNT": define("DS", "/"); break;
    default: define("DS", "/"); break;
}

 //database configuration options and setting of databas global variables
defined('SITE_ROOT') ? null :

//defines the site root. very important. case Sensitive
##################################################################

define('SITE_ROOT', 'C:'.DS.'xampp'.DS.'htdocs'.DS.'contacts');

##################################################################



defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');

// load config file first
require_once(LIB_PATH.DS.'config.php');

// load basic functions next so that everything after can use them
require_once(LIB_PATH.DS.'functions.php');


// load core objects
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'database_object.php');


// load database-related classes

require_once(LIB_PATH.DS.'contacts.php');
require_once(LIB_PATH.DS.'groups.php');
require_once(LIB_PATH.DS.'group_members.php');


?>