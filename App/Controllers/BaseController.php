<?php

Class BaseController
{
    /*
    |   Rendering View.
    */
    public function View($view, $data = Array())
    {
        require_once __DIR__ . '/../Views/' . $view . '.php';
    }
}