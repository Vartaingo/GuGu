<?php
namespace System\Modules;

use \PDO;

class databaseManagerModule
{
    public $database;

    public function __construct(array $database_config)
    {
        $database_dsn = sprintf("mysql:host=%s; dbname=%s; charset=%s", $database_config["HOST"], $database_config["NAME"], $database_config["CHARSET"]);
        $this->database = new PDO($database_dsn, $database_config["USER"], $database_config["PASSWORD"]);
    }

    public function fetch(string $query, bool $numerical = false, array $params = [])
    {
        $sth = $this->database->prepare($query);
        $sth->execute($params);
        if ($numerical) {
            $sth->setFetchMode(PDO::FETCH_NUM);
        } else {
            $sth->setFetchMode(PDO::FETCH_ASSOC);
        }
        return $sth->fetch();
    }

    public function fetchAll(string $query, bool $numerical = false, array $params = [])
    {
        $sth = $this->database->prepare($query);
        $sth->execute($params);
        if ($numerical) {
            $sth->setFetchMode(PDO::FETCH_NUM);
        } else {
            $sth->setFetchMode(PDO::FETCH_ASSOC);
        }
        return $sth->fetchAll();
    }

    public function query(string $query, array $params = [])
    {
        $sth = $this->database->prepare($query);
        return $sth->execute($params);
    }
}
