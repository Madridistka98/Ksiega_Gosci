<?php

namespace GuestBook\Model;

abstract class DbPDO 
{
    protected \PDO $connection;

    function __construct()
    {
        $registry = \GuestBook\Registry::getInstance();
        $conf     = $registry->getDbConfig();

        try {
        $this->connection = new \PDO("mysql:dbname=" . $conf->getDB() . ";host=" . $conf->getHost(), $conf->getUser(), $conf->getPassword());
        } catch (\Exception $e)
        {
            echo $e->getMessage();
            exit;
        }
    }
}