<?php
namespace System;

use System\Core;
use System\View;

class Controller extends Core
{

    public function render(string $file, array $params = [])
    {
        (new View)->render($file, $params);
    }

    public function model(string $model)
    {
      $model = $model . 'Model';
      if (file_exists($file = MODELS_DIR . "/{$model}.php")) {
          include_once($file);

          if (class_exists($model)) {
              return new $model;
          } else {
              exit("Class not defined in model file: {$model}");
          }
      } else {
          exit("Model file not found: {$model}.php");
      }
    }

}
