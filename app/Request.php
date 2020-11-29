<?php

namespace GuestBook;

class Request 
{
    private $url; 
    private $method;
    private $params;
    private $session;
    private $hasSession;
    
    function __construct()
    {
        session_start();

        $this->url = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER["REQUEST_METHOD"];
        if($this->method == "GET") {
            $this->params = $_GET;
        } else {
            $this->params = $_POST;
        }

        if(isset($_SESSION["Admin"])) {
            $this->session = $_SESSION;
            $this->hasSession = true;
        } else {
            $this->hasSession = false;
        }
    }

    public function getParam($param)
    {
        if(isset($this->params[$param])) {
            return $this->params[$param];
        } else {
            return false;
        }
    }

    public function getSessionParam($param)
    {
        if(!$this->hasSession) {
            return false;
        }

        if(isset($this->session[$param])) {
            return $this->session[$param];
        } else {
            return false;
        }
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getHasSession()
    {
        return $this->hasSession;
    }
}