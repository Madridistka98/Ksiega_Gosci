<?php

namespace GuestBook\Commands;

class DeleteCommand extends Command
{
    public function execute() 
    {
        $registry        = \GuestBook\Registry::getInstance();
        $request         = $registry->getRequest();

        if(!$request->getHasSession()) {
            header("Location: /");
        }
        
        $bookModel       = new \GuestBook\Model\BookModel();
        $bookModel->deleteGuest($request->getParam("guest-id"));


        header("Location: /");
    }
}