<?php

namespace GuestBook\Configuration;

class DBConfiguration
{
    private $host;
    private $user;
    private $password;
    private $db;

    function __construct()
    {
        $ini = parse_ini_file(__DIR__ . DIRECTORY_SEPARATOR . "config.ini");
        $this->db = $ini["DB_DATABASE"];
        $this->user = $ini["DB_USER"];
        $this->password = $ini["DB_PASSWORD"];
        $this->host = $ini["DB_HOST"];
    }

    public function getHost() : String
    {
        return $this->host;
    }

    public function getUser() : String
    {
        return $this->user;
    }

    public function getPassword() : String
    {
        return $this->password;
    }
    
    public function getDB() : String
    {
        return $this->db;
    }
}