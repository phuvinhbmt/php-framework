<?php
class View
{
    //put your code here
    protected $viewFile;
    protected $viewData;
    public function __construct($viewFile, $viewData)
    {
        $this->viewFile = $viewFile;
        $this->viewData = $viewData;
    }
    public function render()
    {
        if(file_exists("./app/view/" . $this->viewFile . ".php")) {
            require_once "./app/view/".$this->viewFile.".php";
        }
    }


}