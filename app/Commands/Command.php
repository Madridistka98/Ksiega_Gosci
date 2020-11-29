<?php

namespace GuestBook\Commands;

use GuestBook\Registry;

abstract class Command
{
    public abstract function execute();

    public static function getCommand(String $action) : Command
    {
        $command = null;
        switch($action){
            case "INDEX_GET": {$command = new \GuestBook\Commands\IndexCommand(); break;}
            case "INDEX_POST": {$command = new \GuestBook\Commands\LoginCommand(); break;}
            case "ADD_POST": {$command = new \GuestBook\Commands\AddCommand(); break;}
            case "DELETE_POST": {$command = new \GuestBook\Commands\DeleteCommand(); break;}
            case "KONTAKT_GET": {$command = new \GuestBook\Commands\KontaktCommand(); break; }
            case "INFORMATION_GET": {$command = new \GuestBook\Commands\InformationCommand(); break; }
        }
        return $command;
    }
}