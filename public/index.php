<?php
defined('PROJECT_ROOT') || define('PROJECT_ROOT', realpath(dirname(dirname(__FILE__))).'/');
include "../vendor/autoload.php";

$c = new Core();
$config = $c->init();
if(isset($config['phpSettings']) && is_array($config['phpSettings']))  {
    foreach($config['phpSettings'] as $name=>$val){
        ini_set($name, $val);
    }
}
$c->run();



