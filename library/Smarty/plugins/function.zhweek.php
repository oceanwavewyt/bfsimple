<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {zhweek} function plugin
 *
 * Type:     function<br>
 * Name:     block<br>
 * Purpose:  中文的星期
 * @author wangxing
 * @param array parameters
 * @param Smarty
 * @return string|null
 */

function smarty_function_zhweek($params, &$smarty)
{
	$array = array("星期天","星期一","星期二","星期三","星期四","星期五","星期六");
   	date_default_timezone_set("PRC");
   	$week = $array[date('w')];
    return $week;
}

