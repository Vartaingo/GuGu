<?php
namespace System;

class Config{

  private $config;

  public function __construct()
  {
    $this->config = json_decode(file_get_contents(CONFIG_FILE), true);
  }

  public function getConfig(){
    return $this->config;
  }

  public function getUrl(){
    return $this->config["URL"];
  }

  public function getDatabaseConfig(){
    return $this->config["DATABASE"];
  }

  public function getMailConfig(){
    return $this->config["MAIL"];
  }

  public function getDefaults(){
    return $this->config["DEFAULTS"];
  }

  public function getAdminInfo(){
    return $this->config["ADMIN"];
  }
}
?>
