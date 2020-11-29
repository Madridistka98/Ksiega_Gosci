<?php

namespace GuestBook\Model;

class AdminModel extends DbPDO 
{
    private  $LogIn = 'SELECT * FROM `admin` WHERE `Login` = ? AND `Password` = ?' ;

    public function __construct()
    {
        parent::__construct();
    }

    public function isAdmin(String $email, String $pass) : bool
    {
        $sth = $this->connection->prepare($this->LogIn);
        $sth->execute(array($email, $pass));
        $results = $sth->fetch();
        return $results == True;
    }
}