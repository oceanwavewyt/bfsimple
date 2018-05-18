<?php
class Model {
    private static $_dbconf = [];
    public static $_db = null;
    public static $_model = [];
    public $_table = null;
    public static function getInstance(){
        $name = get_called_class();
        if(isset(self::$_model[$name])) return self::$_model[$name];
        self::$_model[$name] = new static();
        return self::$_model[$name];
    }


    public function __construct() {}

    /**
     * @param $set 设置值
     * @param $where 条件数字
     * @param string $whereStr 条件字符串，如果不传默认是where参数都是and连接
     * @throws Exception
     */
    public function update($set, $where, $whereStr='') {
        if(empty($this->_table)) throw new Exception('table is null');
        $sql = 'update '.$this->_table.' set ';
        $setData  = [];
        $setVal = [];
        foreach($set as $key=>$val){
            $setData[] = $key.'=:'.$key;
            $setVal[':'.$key] = $val;
        }
        $sql.=implode(',',$setData);
        if($whereStr != '') {
            $sql.=' where '.$whereStr;
        }else{
            $whereStr = [];
            foreach($where as $key=>$val){
                $whereStr[] =  $key.'=:'.$key;
            }
            $sql.=' where '.implode(' and ',$whereStr);
        }
        foreach($where as $key=>$val){
            $setVal[':'.$key] = $val;
        }
        $sth = $this->getDb()->prepare($sql);
        return $sth->execute($setVal);
    }

    public function execute($sql, $params=[]) {
        $sth = $this->getDb()->prepare($sql);
        return $sth->execute($params);
    }

    public function fetch($sql, $params=[]) {
        $sth = $this->getDb()->prepare($sql);
        $sth->execute($params);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll($sql, $params=[]) {
        $sth = $this->getDb()->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getDb() {
        if(self::$_db) return self::$_db;
        if(empty(self::$_dbconf)) throw new Exception('db config file is null');
        try {
            self::$_db = new PDO($dsn='mysql:host='.self::$_dbconf['host'].';dbname='.self::$_dbconf['dbname'].';charset=utf8',self::$_dbconf['user'],self::$_dbconf['password']);
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return self::$_db;
    }

    public function __call($name, $arguments) {
        return call_user_func_array([$this->getDb(),$name],$arguments);
    }

    public static function setDatabaseConf($conf) {
        self::$_dbconf = $conf;
    }
}
