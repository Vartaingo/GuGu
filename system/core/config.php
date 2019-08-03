<?php
namespace System;

/** With this class you can read your config.json file or get specific information about your web project **/
class Config
{
    private $config;

    public function __construct()
    {
        if (file_exists(CONFIG_FILE)) {
            $this->config = json_decode(file_get_contents(CONFIG_FILE), true); // Read config.json file
        } else {
            echo "Missing config.json file!";
        }
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getUrl()
    {
        return $this->config["URL"];
    }

    public function getDatabaseConfig()
    {
        return $this->config["DATABASE"];
    }

    public function getMailConfig()
    {
        return $this->config["MAIL"];
    }

    public function getDefaults()
    {
        return $this->config["DEFAULTS"];
    }
}
