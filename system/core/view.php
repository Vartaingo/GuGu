<?php
namespace System;

use System\Core;

class View extends Core
{
	/** If file exists call view file to "layout.html", if isn't show 404 error page.  **/
	public function render($view, array $params = [])
	{
	 		$file = VIEWS_DIR."/{$view}.html";
			if(file_exists($file)) { // If file exists add view to parameters then you can always include to your layout.html file.
				$params['view'] = $file;
				extract($params); // Create variables with parameters.
				require VIEWS_DIR . "/" . $this->getDefaults()["LAYOUT"]; // Get default layout file from config.json file and include to project.
			}
			else {
      	$this->urlManager->E404();
		}
	}
}
?>
