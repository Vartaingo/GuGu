<?php
namespace System\Modules;

use \PDO;

class databaseManagerModule
{

    private $database;

    public function __construct(array $databaseConfig)
    {
        $database_dsn = sprintf("mysql:host=%s; dbname=%s; charset=%s", $databaseConfig["HOST"], $databaseConfig["NAME"], $databaseConfig["CHARSET"]);
        $this->database = new PDO($database_dsn, $databaseConfig["USER"], $databaseConfig["PASSWORD"]);
    }

    public function fetch(string $query, bool $numerical = False, array $params = [])
    {
        $sth = $this->database->prepare($query);
        $sth->execute($params);
        if ($numerical){
            $sth->setFetchMode(PDO::FETCH_NUM);
        }
        else{
            $sth->setFetchMode(PDO::FETCH_ASSOC);
        }
        return $sth->fetch();
    }

    public function fetchAll(string $query, bool $numerical = False, array $params = [])
    {
        $sth = $this->database->prepare($query);
        $sth->execute($params);
        if ($numerical){
            $sth->setFetchMode(PDO::FETCH_NUM);
        }
        else{
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
