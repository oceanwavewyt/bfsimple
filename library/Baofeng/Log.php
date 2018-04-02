<?php

class Log {
    const INFO = 'INFO';
    const WARN = 'WARN';
    const ERROR = 'ERROR';
    private static $_ins = [];
    private $_filename = null;
    public static function getInstance($logfile){
        if(isset(self::$_ins[$logfile])) return self::$_ins[$logfile];
        self::$_ins[$logfile] = new Log($logfile);
        return self::$_ins[$logfile];
    }
    public function __construct($logfile){
        $this->_filename = $logfile;
        is_dir(dirname($this->_filename)) || mkdir(dirname($this->_filename),0777);
    }
    public function write($msg, $type=self::INFO) {
        file_put_contents($this->_filename, date("[Y-m-d H:i:s] ").$type.' '.$msg."\n", FILE_APPEND);
    }

}