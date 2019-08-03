<?php
namespace System;

use System\Core;
use Modules\stringProcessingModule;
use Modules\communicationModule;
use Modules\fileManagerModule;

/** In this class you can add external modules for your web project and you can able to access them from your model file. **/
class Model extends Core
{
    public function strProcess()
    {
        require_once(MODULES_DIR . "/stringProcessing.php");
        return new stringProcessingModule();
    }

    public function communication()
    {
        require_once(MODULES_DIR . "/communication.php");
        return new communicationModule($this->getConfig());
    }

    public function fileManager()
    {
        require_once(MODULES_DIR . "/fileManager.php");
        return new fileManagerModule();
    }
}
