<?php

namespace GuestBook\Commands;

class LoginCommand extends Command
{
    public function execute() 
    {
        $registry        = \GuestBook\Registry::getInstance();
        $request         = $registry->getRequest();
        $login  = $request->getParam('admin')["login"];
        $pass   = $request->getParam('admin')["password"];
        $adminModel       = new \GuestBook\Model\AdminModel();
        $results         = $adminModel->isAdmin($login, $pass);
        if($results) {
            $_SESSION["Admin"] = "Test";
            header("Location: /");
        } else {
            header("Location: /");
        }
    }
}