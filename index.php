<?php
use System\Core;

error_reporting(E_ALL);
ini_set("display_errors", 1);

/**Constants**/

//Application Directory
define("APP_DIR",__DIR__);

//System Directory
define("SYS_DIR", APP_DIR."/system");

//Config File
define("CONFIG_FILE", APP_DIR."/config.json");

//Core Directory
define("CORE_DIR",SYS_DIR."/core");

//Model Directory
define("MODELS_DIR",SYS_DIR."/models");

//View Directory
define("VIEWS_DIR",SYS_DIR."/views");

//Controller Directory
define("CONTROLLERS_DIR",SYS_DIR."/controllers");

//Modules Directory
define("MODULES_DIR",SYS_DIR."/modules");

//System Modules Directory
define("SYS_MODULES_DIR",SYS_DIR."/modules/system");

//Include Core Classes
require_once CORE_DIR."/config.php";
require_once CORE_DIR."/core.php";
require_once CORE_DIR."/model.php";
require_once CORE_DIR."/view.php";
require_once CORE_DIR."/controller.php";

//Start System
(new Core)->start();
?>
