<?php

namespace GuestBook\Commands;

class KontaktCommand extends Command
{
    public function execute() 
    {
        $registry        = \GuestBook\Registry::getInstance();
        $request         = $registry->getRequest();

        if($request->getHasSession()) {
            $adminName = $request->getSessionParam("Admin");
        }

        $view = new \GuestBook\Views\Kontakt();

        if(isset($adminName)) {
            $view->setAdminName($adminName);
        }
        
        $view->render();
    }
}