<?php

class Application
{
    protected $controller = "HomeController"; // default controller: HomeController
    protected $action     = "uploadCSV"; //default action: uploadCSV
    protected $params     = [];

    public function __construct()
    {
        $arr = $this->prepareURL();

        // parse controller
        if (file_exists("./app/controller/".$arr[0].".php")) { // check if controller file exists
            $this->controller = $arr[0];
            unset($arr[0]);
        }
        require_once "./app/controller/".$this->controller.".php";
        $this->controller = new $this->controller;

        // parse action
        if (isset($arr[1])) {
            if (method_exists($this->controller, $arr[1])) { //check if action exists in Controller file
                $this->action = $arr[1];
            }
            unset($arr[1]);
        }

        // parse parameters
        $this->params = $arr ? array_values($arr) : [];

        call_user_func_array([$this->controller, $this->action], $this->params);
    }

    protected function prepareURL()
    {
        if (isset($_GET["url"])) {
            $request = filter_var(trim($_GET["url"], "/")); // remove white space in url
            return explode("/", $request); //separate parameter by '/' and store in array
        }
    }
}