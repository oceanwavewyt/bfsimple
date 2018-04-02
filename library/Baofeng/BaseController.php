<?php

class BaseController
{
    protected $request = null;
    protected $view = null;
    protected $templatePath = null;
    function __contruct(){}

    public function indexAction() {

    }

    public function init($request) {
        $this->request = $request;
        $this->templatePath = rtrim(PROJECT_ROOT,'/')."/modules/".$request->get('module').'/view/';
        if(is_dir($this->templatePath)) {
            $this->view = new view($this->request);
        }
    }

    protected function display($filename) {
        if($this->templatePath == null || !file_exists($this->templatePath.$filename)) {
            throw new Exception($this->templatePath.$filename.' file not found');
        }
        $this->view->display($filename);
    }

}