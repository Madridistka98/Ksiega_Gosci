<?php

namespace GuestBook;

class Registry 
{
    private static ?\GuestBook\Registry $registry = null;
    private ?\GuestBook\Configuration\DBConfiguration $dbConfig = null;
    private ?\GuestBook\Request $request = null;

    private function __construct()
    {
    }

    public static function getInstance() : self {

        if(is_null(self::$registry)) {
            self::$registry = new self();
        }
        return self::$registry;
    }

    public function getDbConfig() : \GuestBook\Configuration\DBConfiguration
    {
        if(is_null($this->dbConfig)) {
            $this->dbConfig = new \GuestBook\Configuration\DBConfiguration();
        }
        return $this->dbConfig;
    }

    public function getRequest() : \GuestBook\Request 
    {
        if(is_null($this->request)) {
            $this->request = new \GuestBook\Request();
        }
        return $this->request;
    }


}