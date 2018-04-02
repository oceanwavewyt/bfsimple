<?php

/**
 * Smarty {tips} function plugin
 *
 * Type:     function<br>
 * Name:     tips<br>
 * Purpose:  实现tips播放功能
 * @param array parameters
 * @param Smarty
 * @return string|null
 */
function smarty_function_tips($params, &$smarty)
{
	
	$tipsType = $params["tips_type"];
	$areacode = $params["areacode"];
	
    $params = $params["params"];
    $content = $params["content"];
    $type = $content["type"];
    
    
    $boxParams = array(
        "gotoblank" => array("title", "type", "url", "isad"),
        "play" => array("title", "wid", "aid", "vid", "isad","movieid","format"),
        "tipsbox" => array("title", "type", "url", "tab", "isad"),
        "tipspop" => array("title", "type", "url", "tab", "isad"),
   		"showbox" => array("title", "type", "url", "tab", "isad")
    );
    $needParams = array("blockid" => "areacode", "id" => "logid", "page" => "groupid","auto_sort" => "sort");
    
    $box["Box_Type"] = $type;
    
    //类型参数
    foreach($boxParams[$type] as $param){
        $box[$param] = $content[$param];
    }
    //必要参数
    foreach($needParams as $key => $param){
        $box[$param] = $params[$key];
    }
	
    //指定areacode
    if($areacode){
    	$box["areacode"] = $areacode;
    }
    
    $tipsObj = new Cms_Tips($box);
    
    $string = "";
    if ($tipsType == "log"){
    	$string = $tipsObj->getClickLogString();
    }elseif ($tipsType == "storm"){
    	$string = $tipsObj->getStormString();
    }elseif ($tipsType =="stormBox"){
   		$string = "Storm://".$tipsObj->getStormBoxString();
    }
    return $string;
}

