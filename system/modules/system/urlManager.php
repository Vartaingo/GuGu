<?php
namespace System\Modules;

class urlManagerModule
{
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function E404()
    {
        exit(header("Location:" . $this->url . '/404'));
    }

    public function redirect(string $url, bool $redirect = true)
    {
        if ($redirect) {
            exit(header("Location:".$url));
        }
    }
}
