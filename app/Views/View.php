<?php

namespace GuestBook\Views;

abstract class View
{
    public static $TEMPLATE_DIR = __DIR__ . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR;
    public $adminName;

    public function setAdminName(String $admin)
    {
        $this->adminName = $admin;
    }
    
    public function render()
    {
        ob_start();
        require_once self::$TEMPLATE_DIR . "template.phtml";
        ob_flush();
    }

    protected abstract function toRenderPageContent();
}