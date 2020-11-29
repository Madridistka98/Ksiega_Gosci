<?php

namespace GuestBook\Controller;

use GuestBook\Commands\Command;

class AddController implements Controller
{
    private $path = "ADD";

    public function __construct()
    {
        
    }

    public function execute() {
        $registry        = \GuestBook\Registry::getInstance();
        $request         = $registry->getRequest();
        $method          = $request->getMethod();

        $command = Command::getCommand($this->path . "_" . $method);

        $command->execute();
    }
}