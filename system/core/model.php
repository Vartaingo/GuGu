<?php
namespace System;

use System\Core;
use Modules\stringProcessingModule;
use Modules\communicationModule;

class Model extends Core
{

	public function strProcess(){
		require_once(MODULES_DIR . "/stringProcessing.php");
		return new stringProcessingModule();
	}

	public function communication(){
		require_once(MODULES_DIR . "/communication.php");
		return new communicationModule($this->getConfig());
	}
}
