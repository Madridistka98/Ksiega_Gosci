<?php

namespace GuestBook\Model;

class BookModel extends DbPDO 
{
    private  $SelectAll = "SELECT * FROM `GuestBook`";
    private  $Delete    = "DELETE FROM `GuestBook` WHERE ID = ?";
    private  $Insert    = "INSERT INTO `GuestBook` (`Email`,`Nickname`,`Text`) VALUES (?, ?, ?)";

    public function __construct()
    {
        parent::__construct();
    }

    public function getGuests() : Array
    {
        $sth = $this->connection->prepare($this->SelectAll);
        $sth->execute();
        $results = $sth->fetchAll();
        return $results;
    }

    public function insertGuest(String $email, String $name, String $text)
    {
        $sth = $this->connection->prepare($this->Insert);
        $sth->execute(array($email, $name, $text));
    }

    public function deleteGuest(int $ID)
    {
        $sth = $this->connection->prepare($this->Delete);
        $sth->execute(array($ID));
    }
}