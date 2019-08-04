<?php
namespace Modules;

class userManagerModule
{
    public function __construct(object $database, object $stringProcessor)
    {
        $this->stringProcessor = $stringProcessor;
        $this->databaseManager = $database;
    }
    public function login($user, $password, $remember = false)
    {
        if (!$this->isLoggedIn() && $password == $this->databaseManager->fetch("SELECT password FROM users WHERE name=?", true, array($user))[0]) {
            $token = $this->stringProcessor->createToken(array($user,$password));
            $_SESSION["USER"] = $token;
            $_SESSION["USER_NAME"] = $user;
            if ($remember) {
                setcookie("USER", $token, time() + 60*60*24*30, "/");
                setcookie("USER_NAME", $user, time() + 60*60*24*30, "/");
            }
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        if ($this->isLoggedIn()) {
            setcookie("USER", null, -1, "/");
            setcookie("USER_NAME", null, -1, "/");
            session_destroy();
            return true;
        } else {
            return false;
        }
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION["USER"])) {
            $user = $this->databaseManager->fetch("SELECT name,password FROM users WHERE name=?", false, array($_SESSION["USER_NAME"]));
            if ($_SESSION["USER"] == $this->stringProcessor->createToken(array($user["name"],$user["password"]))) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    public function userDefine()
    {
        if (isset($_COOKIE["USER"])) {
            $user =$this->databaseManager->fetch("SELECT name,password FROM users WHERE name=?", false, array($_COOKIE["USER_NAME"]));
            if ($_COOKIE["USER"] == $this->stringProcessor->createToken(array($user["name"],$user["password"]))) {
                $_SESSION["USER"] = $_COOKIE["USER"];
                $_SESSION["USER_NAME"] = $_COOKIE["USER_NAME"];
                return true;
            } else {
                return false;
            }
        }
    }

    public function checkUserLevel($level)
    {
        if (isset($_SESSION["USER"]) && $this->databaseManager->fetch("SELECT level FROM users WHERE name=?", true, $_SESSION["USER_NAME"])[0] >= $level) {
            return true;
        } else {
            return false;
        }
    }
}
