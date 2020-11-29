<?php

namespace GuestBook\Commands;

class AddCommand extends Command
{
    public function execute() 
    {
        $registry        = \GuestBook\Registry::getInstance();
        $request         = $registry->getRequest();
        
        $bookModel       = new \GuestBook\Model\BookModel();
        $bookModel->insertGuest($request->getParam('email'), $request->getParam('nickname'), $request->getParam('message'));


        header("Location: /");
    }
}