<?php

namespace GuestBook\Commands;

class IndexCommand extends Command
{
    public function execute() 
    {
        $registry        = \GuestBook\Registry::getInstance();
        $request         = $registry->getRequest();

        if($request->getHasSession()) {
            $adminName = $request->getSessionParam("Admin");
        }

        $bookModel       = new \GuestBook\Model\BookModel();
        $results         = $bookModel->getGuests();

        $view = new \GuestBook\Views\MainPage();
        if(isset($adminName)) {
            $view->setAdminName($adminName);
        }

        $view->setGuests($results);

        $view->render();
    }
}