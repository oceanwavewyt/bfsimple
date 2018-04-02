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
 * Purpose:  实现盒子的头部
 * 调用： {newbox tplname=header type=enc}
 *		tplname 模板的头部名称
 *      type： index|movie|tv|comic|enc|edu|micv
 * @author wangyutian
 * @param array parameters
 * @param Smarty
 * @return string|null
 */
function smarty_function_newbox($params, &$smarty)
{
    $tplInfo = getRemoteNewInfo($params["tplname"]);

    $fileUrl = PROJECT_ROOT . "/application/templates/Smarty/Template/Block/newbox-" . $params["tplname"]. ".tpl.htm";

    if($tplInfo){
	   file_put_contents($fileUrl , $tplInfo);
    }
	foreach($params as $key => $val) {
    	$smarty->assign($key, $val);
	}
    $text = $smarty->fetch($fileUrl);
    return preg_replace('!\s+!', ' ', $text);
}

//得到远程模板
function getRemoteNewInfo($name) 
{
    $url = "http://moviebox.baofeng.net/newbox1.0/movie/template/".$name.'.tpl.html';
    $ctx = stream_context_create(
        array( 'http' => array('timeout' => 2))
        );  
    return file_get_contents($url,0,$ctx);
}
/*
function getSearchDefault($params)
{
	$channel = 1;
	if(isset($params['channel']) && in_array($params['channel'], array(1,2,3))){
		$channel = $params['channel'];
	}	
	$url = 'http://moviebox.baofeng.net/newbox1.0/json/boxsearch/minitext_'.$channel.'.js';
	return file_get_contents($url);		
} 
*/  
