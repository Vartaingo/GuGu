<?php
namespace System\Modules;

class urlManagerModule{

  public function __construct(string $url)
  {
    $this->url = $url;
  }

  public function E404()
  {
  	header("Location:" . $this->url . '/404');
  }

}
?>
