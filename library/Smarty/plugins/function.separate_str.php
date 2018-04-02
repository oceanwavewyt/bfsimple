<?php

/**
 * Smarty {tips} function plugin
 *
 * Type:     function<br>
 * Name:     separate_str<br>       
 * Purpose:  实现数组当中一些字段组成字符串
 * example: {separate_str array=$row.people  name="name" filtername="typename" filtervalue="hello" separate=","}      
 * @param array parameters
 * @param Smarty
 * @return string|null
 */
function smarty_function_separate_str($params, &$smarty)
{
    $arr = $params['array'];
	$separate = $params['separate'];
	if(!isset($params['name'])){
		return implode($separate, $arr);
	}	
	$name = $params['name'];
	$isFilter = 0;
	if(isset($params['filtername'])) {
		$filterField = $params['filtername'];
		$filterValue = $params['filtervalue'];
		$isFilter = 1;
	}
	$ret = array();
	foreach($arr as $val) {
		if(trim($val[$name])=='') continue;
		if($isFilter == 0) {
			$ret[] = $val[$name];
		}else{
			if($val[$filterField] != $filterValue) 	continue;
			$ret[] = $val[$name];
		}
	}
	return implode($separate, $ret);
}
