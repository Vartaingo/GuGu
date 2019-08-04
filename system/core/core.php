<?php
namespace System;

use System\Config;
use System\Model;
use System\Modules\urlManagerModule;
use System\Modules\databaseManagerModule;

class Core extends Config
{
    public function __construct()
    {
        parent::__construct(); // Call parent __construct() function for collecting web project's information from config.json file.
        $this->callSysModules(); // Call system modules.
    }

    /** Call system modules. **/
    private function callSysModules()
    {
        require_once(SYS_MODULES_DIR."/urlManager.php"); // Require urlManager module from SYS_MODULES_DIR.
        require_once(SYS_MODULES_DIR."/databaseManager.php"); // Require databaseManager module from SYS_MODULES_DIR.
        $this->urlManager = new urlManagerModule($this->getUrl()); // Create urlManager object.
        $this->databaseManager = new databaseManagerModule($this->getDatabaseConfig()); // Create databaseManager object.
    }

    /** Start the system and get url parameters from getParams() function. **/
    public function start()
    {
        $this->route($this->getParams());
    }

    /** Get parameters from url. **/
    private function getParams()
    {
        if (isset($_GET["class"]) && isset($_GET["action"])) { // If class and action exists return all parameters.
            return $_GET;
        } else {
            $params["class"] = $this->getDefaults()["CLASS"]; // Call default class value from config.php.
            $params["action"] = $this->getDefaults()["ACTION"]; // Call default action value from config.php.
            return array_merge($params, $_GET); // If there is more parameters beside class and action merge all of them.
        }
    }

    /** Call the controller file and check if there are a class name and function in the file, if it isn't show 404 error page. **/
    private function route(array $params)
    {
        $controllerClass = $params["class"] . "Controller"; // Merge class name and "Controller" string because all controller files are ending with "Controller".
      if (file_exists($file = CONTROLLERS_DIR . "/{$controllerClass}.php")) { // Check if file exists then if exists include it for once.
          include_once($file);
          if (class_exists($controllerClass)) { // Check if class exists then if exists create controller object from target controller.
              $controller = new $controllerClass;
              if (method_exists($controller, $params["action"])) { // Check if method exists then if exists call target function from the controller and send parameters to it.
                  call_user_func_array([$controller, $params["action"]], array($params));
              } else {
                  $this->urlManager->E404();
              }
          } else {
              $this->urlManager->E404();
          }
      } else {
          $this->urlManager->E404();
      }
    }
}
