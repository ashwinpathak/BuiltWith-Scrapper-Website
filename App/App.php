<?php

require_once __DIR__ . '/init.php';

Class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = false;

    public function __construct()
    {
        $url = $this->_parseURL(); // parsing URL

        /*
        |   Checking whether Controller file exists or not.
        */
        if(file_exists(__DIR__ . '/Controllers/' . $url[0] . 'Controller.php')) {
            $this->controller = $url[0]; // If yes then set that file as controller
            unset($url[0]); // and then unset it from $url variable
            $url = array_values($url); // this is the bring KEY NUMBERS from 0.
        }

        /*
        |   Include that Controller File
        |   And CREATING a new INSTANCE of that controller
        */
        require_once __DIR__ . '/Controllers/' . $this->controller . 'Controller.php';
        $this->controller = new $this->controller;

        /*
        |   Checking wheter method exists or not
        |   If yes then using it and then unsetting it from $url variable
        */
        if(isset($url[0])) {
            if(method_exists($this->controller, $url[0])) {
                $this->method = $url[0];
                unset($url[0]);
            }
        }

        /*
        |   After unsetting Controller & Method, parameters are left
        |   We are making that parameters as a new URL array which
        |   starts from INDEX 0
        */
        $this->params = ($url) ? array_values($url) : Array();

        /*
        |   Calling the Controller Object with desired Method
        |   And passing in Parameters of URL
        */
        echo call_user_func_array(Array($this->controller, $this->method), $this->params);
    }

    /*
    |   Clearing defects from the URL.
    */
    private function _parseURL()
    {
        if(isset($_GET['url']) && !empty($_GET['url'])) {
            $url = explode('/', filter_var(trim(rtrim($_GET['url'], '/')), FILTER_SANITIZE_URL));
            return $url;
        }
    }
}