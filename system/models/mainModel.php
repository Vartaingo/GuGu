<?php
use System\Model;

class mainModel extends Model{

  public function get(array  $params = []){
    $data["content"] = "GuGu";
    return $data;
  }
}
