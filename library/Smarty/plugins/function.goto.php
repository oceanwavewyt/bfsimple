<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {goto} function plugin
 *
 * Type:     function<br>
 * Name:     box<br>
 * Purpose:  实现页面链接功能json拼装
 * @author wangxing
 * @param array parameters
 * @param Smarty
 * @return string|null
 */
function smarty_function_goto($params, &$smarty)
{
    $url = $params["url"];
    $params = $params["params"];
    $type = "gotoself";
    
    $needParams = array("blockid" => "areacode", "id" => "logid");
    $box["Box_Type"] = $type;
	$box["url"] = $params["content"][$url];
    
    //必要参数
    foreach($needParams as $key => $param){
        $box[$param] = $params[$key];
    }
    
	$aTag  = " href='" . $box["url"] . "'";
    $aTag .= " box='" . Zend_Json::encode($box) . "'";
    $aTag .= " onmousedown='boxClick({\"event\" : event, \"elem\" : this})'";
    return $aTag;

}

