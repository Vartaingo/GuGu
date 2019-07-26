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
    parent::__construct();
    $this->callSysModules();
  }

      public function start(){
          $this->run($this->getParams());
      }

    private function callSysModules(){
      require_once(SYS_MODULES_DIR."/urlManager.php");
      require_once(SYS_MODULES_DIR."/databaseManager.php");
      $this->urlManager = new urlManagerModule($this->getUrl());
      $this->databaseManager = new databaseManagerModule($this->getDatabaseConfig());
    }

    private function getParams()
    {
         if (isset($_GET["class"]) && isset($_GET["action"])) {
            return $_GET;
        }
        else{
            $params["class"] = $this->getDefaults()["CLASS"];
            $params["action"] = $this->getDefaults()["ACTION"];
            return array_merge($params, $_GET);
        }
    }

    private function run(array $params)
    {
        $controllerClass = $params["class"] . "Controller";
        if (file_exists($file = CONTROLLERS_DIR . "/{$controllerClass}.php")) {
            include_once($file);
            if (class_exists($controllerClass)) {
                $controller = new $controllerClass;
                if (method_exists($controller, $params["action"])) {
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
