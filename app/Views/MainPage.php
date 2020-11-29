<?php

namespace GuestBook\Views;

class MainPage extends View 
{
    private $guests;

    public function setGuests($guests)
    {
        $this->guests = $guests;
    }

    protected function toRenderPageContent()
    {
        print '<div class="wrapper__guest-book my-5">
        <div class="container bg-light p-3">';
        require_once View::$TEMPLATE_DIR . "guest-form.phtml";
        print '</div>
        <div class="container my-3 p-3">
        <div class="accordion" id="accordionExample">';
        foreach ($this->guests as $guest) {
            require View::$TEMPLATE_DIR . "guest-card.phtml";
        } 
        print '</div></div>
        </div>';
    }
}