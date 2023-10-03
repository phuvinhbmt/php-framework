<?php

class Controller
{
    protected $view;
    protected $model;

    public function model($modelName)
    {
        require_once "./app/model/".$modelName.".php";
        return new $modelName;
    }

    public function view($viewName, $data = [])
    {
//        require_once "./app/view/".$viewName.".php";
        $this->view = new View($viewName, $data);
//        return $this->view;
    }
}