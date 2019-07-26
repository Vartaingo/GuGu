<?php
namespace System;

use System\Core;

class View extends Core
{
	public function render($view, array $params = [])
	{
	 		$file = VIEWS_DIR."/{$view}.html";
			if(file_exists($file)) {
				$params['view'] = $file;
				extract($params);
				require VIEWS_DIR . "/" . $this->getDefaults()["LAYOUT"];
			}
			else {
      	$this->urlManager->E404();
		}
	}
}
