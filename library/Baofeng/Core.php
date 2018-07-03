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
        $this->route($baseConf);
    }


    private function route(&$baseConf) {
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
        $dbconf = $baseConf['db'];
        if (!empty($dbconf)) {
            Model::setDatabaseConf($dbconf);
        }
        if(!$this->_request->getCli()) {
            if (isset($baseConf['auth']) && $baseConf['auth'] == 'on') {
                $authConf = $this->_request->getConfig('auth');
                Auth::check($authConf, $module, $controller, $action);
                $this->_request->setUser($authConf);
            }
            if (isset($baseConf['aclFunction'])) {
                if (!call_user_func($baseConf['aclFunction'], $this->_request)) {
                    die('无权限!');
                }
            }
        }
        $cont = new $className();
        $actionName = $action.'Action';
        if(!method_exists($cont, $actionName)) throw new Exception($actionName.' not found.');
        $cont->init($this->_request);
        return $cont->$actionName();
    }

}