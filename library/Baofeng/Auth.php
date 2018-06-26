<?php
/**
 * Created by PhpStorm.
 * User: wangyutian
 * Date: 2018/6/25
 * Time: 16:11
 */
class Auth {
    private static $cookieAuthName = '__bfyestefr__';
    private static function checkCookie(&$config) {
        if(!isset($_COOKIE[self::$cookieAuthName])) return false;
        $idstr = [];
        foreach($config['cookie'] as $cid) {
            if(!isset($_COOKIE[$cid])) return false;
            $idstr[] = $_COOKIE[$cid];
        }

        if($_COOKIE[self::$cookieAuthName] != self::getAuthName($idstr,$config)) {
            return false;
        }
        return true;
    }
    private static function getAuthName($idarr, $config) {
        if(isset($config['authkey'])) {
            $config['authkey'] = 'gnqX&+qSCc^uu7jA,vL#a0uX4x_zoX%u';
        }
        return md5(json_encode($idarr).$config['authkey']);
    }

    public static function check($config, $module, $controller, $action) {
        if(!isset($config['login'])) throw new Exception("请配置auth.php中的login参数");
        $curAct = implode('/',['',$module, $controller, $action]);
        $login = rtrim($config['login'],'/');
        if(strtolower($curAct) == strtolower($login)) return true;
        if(isset($config['resource']['allow']) && is_array($config['resource']['allow'])) {
            foreach ($config['resource']['allow'] as $val){
                if(rtrim($val,'/') != $curAct) continue;
                return true;
            }
        }
        //检查登录
        if(self::checkCookie($config)) return true;
        header("Location:".$login);
        exit(1);
    }

    /**
     * @param $params 需要和auth.php配置文件中的cookie参数一致
     * 如 [$id,$username,$email]
     *
     */
    public static function success($request, $params) {
        $config = $request->getConfig('auth');
        if(!isset($config['cookie']))  throw new Exception("请配置auth.php中的cookie参数");
        $idstr = [];
        foreach($config['cookie'] as $cid) {
            if(!isset($params[$cid]))  throw new Exception("cookie参数失败");
            $idstr[] = $params[$cid];
            setcookie($cid,$params[$cid],time()+3600,'/');
        }
        setcookie(self::$cookieAuthName,self::getAuthName($idstr,$config),time()+3600,'/');
        return true;
    }
}