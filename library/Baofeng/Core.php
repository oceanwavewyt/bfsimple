<?php
class Core {

    public $_request = null;
    function __construct(){
        $this->_request = new Request();
    }

    public function init() {
        return $this->_request->getConfig();
    }


    public function run() {
        //记录log
        $baseConf = $this->_request->getConfig('base');
        if(isset($baseConf['log'])) {
            $path = PROJECT_ROOT.$baseConf['log'];
            Log::getInstance($path)->write(json_encode($this->_request->getUrlParams()));
        }
        $this->route();
    }


    private function route() {
        $default = ['module'=>'index','controller'=>'Index','action'=>'index'];
        foreach($default as $name=>$defval) {
            if(empty($this->_request->get($name)) || trim($this->_request->get($name)) == '') {
                $$name = $defval;
            }else{
                $$name = $this->_request->get($name);
            }
        }
        $className = $module.'_'.ucfirst($controller).'Controller';
        if(!class_exists($className)) throw new Exception($className.' not found.');
        $cont = new $className();
        $actionName = $action.'Action';
        if(!method_exists($cont, $actionName)) throw new Exception($actionName.' not found.');
        $dbconf = $this->_request->getConfig('base','db');
        if(!empty($dbconf)) {
            Model::setDatabaseConf($dbconf);
        }
        $cont->init($this->_request);
        return $cont->$actionName();
    }

}