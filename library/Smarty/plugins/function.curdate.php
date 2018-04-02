<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {curdate} function plugin
 *
 * Type:     function<br>
 * Name:     block<br>
 * Purpose:  实现页面可嵌入板块
 * @author wangxing
 * @param array parameters
 * @param Smarty
 * @return string|null
 */

function smarty_function_curdate($params, &$smarty)
{
	$array = array("星期天","星期一","星期二","星期三","星期四","星期五","星期六");
   	date_default_timezone_set("PRC");
   	$time = time();
   	$date = date("Y年m月d日",$time);
   	$week = $array[date('w')];
    return $date." ".$week;
}

