<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {box_json} function plugin
 *
 * Type:     function<br>
 * Name:     box_json<br>
 * Purpose:  实现页面链接功能json拼装
 * @author wangxing
 * @param array parameters
 * @param Smarty
 * @return string|null
 */
function smarty_function_box_json($params, &$smarty)
{
    $params = $params["params"];
    $content = $params["content"];
    $type = $content["type"];
    
    
    $boxParams = array(
        "gotoblank" => array("type", "url"),
        "gotoself" => array("type", "url", "tab"),
        "play" => array("wid", "aid", "vid"),
        "playout" => array("wid", "aid", "vid"),
        "frameBox" => array("type", "url"),
        "frameNew" => array("type", "url"),
        "showbox" => array("type", "url", "tab"),
    );
    $needParams = array("blockid" => "areacode", "id" => "logid", "movieid"=>"movieid");
    
    $needContentParams = array("isad" => "isad", "right" => "right", "title" => "title", "movieid"=>"movieid");
    
    $box["Box_Type"] = $type;
    
    //类型参数
    foreach($boxParams[$type] as $param){
        $box[$param] = $content[$param];
    }
    
    //必要参数
    foreach($needParams as $key => $param){
        $box[$param] = $params[$key];
    }
    
 	//内容参数
    foreach($needContentParams as $key => $param){
    	$box[$param] = ($param=="title")?htmlspecialchars($content[$key]):$content[$key];
    }
    //特殊参数(单视频)
    if(in_array($type,array("play","playout")) && $box["vid"] > 0){
        $modelVideo = PlayResource_Model_Video::getInstance($box["wid"]);
        //var_dump($modelVideo);exit;
        $video = $modelVideo->findById($box["vid"]);
        $box["iid"] = $video->iid;
    }
    
    return Zend_Json::encode($box);
}

