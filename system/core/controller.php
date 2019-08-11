<?php
namespace System;

use System\Core;
use System\View;

class Controller extends Core
{
    /** Create View object and call render function from it. **/
    public function render(string $file, array $params = [], $layout = null)
    {
        (new View)->render($file, $params, $layout);
    }

    /** If model file exists return the model class, if it isn't show error. **/
    public function model(string $model)
    {
        $model = $model . 'Model'; // Merge model name and "Model" string because all model files are ending with "Model".
      if (file_exists($file = MODELS_DIR . "/{$model}.php")) { // Check if file exists then if exists include it for once.
          include_once($file);

          if (class_exists($model)) {  // Check if class exists then if exists return target model.
              return new $model;
          } else {
              exit("Class not defined in model file: {$model}");
          }
      } else {
          exit("Model file not found: {$model}.php");
      }
    }
}
