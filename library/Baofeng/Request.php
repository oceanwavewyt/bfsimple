<?php
class Request {
    public static $_params = [];
    public static $_urlparams = [];
    public static $_config = [];
    private  $paramConf = ['1'=>'module','2'=>'controller','3'=>'action'];
    function __construct() {
        if(isset($_SERVER['env'])) {
            self::$_params['env'] = $_SERVER['env'];
        }
        if(isset($_SERVER['ENV'])) {
            self::$_params['env'] = $_SERVER['ENV'];
        }
        $this->parserParams();
    }

    /**
     * @param $name 参数的名字
	 * @param $default 默认值
     * @return mixed|null
     */
    public function get($name,$default=null) {
        if(isset(self::$_params[$name])) return self::$_params[$name];
        return $default;
    }

    /**
     * 获得所有的参数
     * @return array
     */
    public function gets() {
        return self::$_params;
    }

    /**
     * @param string $name (config文件夹下的配置文件的文件名)
     * @param $string $field 配置某个选项
     */
    public function getConfig($name='base',$field='') {
        $env = $this->get('env');
        if($env != '') {
            $name .='_'.$env;
        }
        if(isset(self::$_config[$name])){
            return ($field=='')?self::$_config[$name]:self::$_config[$name][$field];
        }
        $filename = PROJECT_ROOT.'/config/'.$name.'.php';
        if(!file_exists($filename)) return [];
        $conf = include $filename;
        if(!is_array($conf)) throw new Exception($filename.' content add return');
        self::$_config[$name] = $conf;
        return ($field=='')?$conf:$conf[$field];
    }

    public function getUrlParams(){
        return self::$_urlparams;
    }
    private function parserParams() {
        if(PHP_SAPI == 'cli') {
            $ok = $this->cli();
            if(!$ok) throw new Exception("parameter error,need for modules controller action");
        }else{
            $params = explode('&',$_SERVER["QUERY_STRING"]);
            $arr = explode('/', $params[0]);
            foreach($arr as $id=>$val) {
                if(isset($this->paramConf[$id+1])) {
                    self::$_params[$this->paramConf[$id+1]] = $arr[$id];
                }elseif($id > 2 && $id%2 == 1) {
                     if(!isset($arr[$id+1])) break;
                     self::$_params[$arr[$id]] = $arr[$id+1];
                }
            }
            if(count($params) > 1) {
                foreach($params as $key=>$val){
                    if($key == 0) continue;
                    $arr = explode('=', $val);
                    if(!isset($arr[1])) break;
                    self::$_params[$arr[0]] = $arr[1];
                }
            }
            self::$_urlparams = self::$_params;
            self::$_params = array_merge(self::$_params, $_POST);
        }
    }
    private function cli() {
        $params = $GLOBALS['argv'];
        if(count($params) < 4) return false;
        foreach($params as $id=>$name){
            if(isset($this->paramConf[$id])) {
                self::$_params[$this->paramConf[$id]] = $params[$id];
            }else{
                $arr = explode('=', $name);
                if(count($arr[0]) == 2) {
                    self::$_params[$arr[0]] = $arr[1];
                }else{
                    self::$_params[$id] = $arr[0];
                }
            }
        }
        return true;
    }
}
