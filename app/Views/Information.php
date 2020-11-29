<?php

namespace GuestBook\Views;

class Information extends View 
{

    protected function toRenderPageContent()
    {
        print '<div class="wrapper__guest-book my-5">
        <div class="container bg-light p-3">';
        require_once View::$TEMPLATE_DIR . "information.phtml";
        print '</div>
        </div>';
    }
}