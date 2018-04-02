<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {hdblock} function plugin
 *
 * Type:     function<br>
 * Name:     block<br>
 * Purpose:  实现调用暴高清远程模板，并进行组装
 * @author wangxing
 * @param array parameters
 * @param Smarty
 * @return string|null
 */

function smarty_function_hdblock($params, &$smarty)
{
    $params["page"] = $params["page"] > 0 ? $params["page"] : 1;
    $modelData = Publish_Model_Data::getInstance();
    if($params['data']!="no") {
        if(@$smarty->_tpl_vars['cron_block_id']){ //如果是计划任务模式
            if($smarty->_tpl_vars['cron_block_id'] == $params["data_block_id"] && $smarty->_tpl_vars['cron_page'] == $params["page"]){
    			//如果数据板块ID 和 页数page都一致，则取当前数据
                $dataSet = $modelData->getCurrentDataByBlockIdAndPage($params["data_block_id"], $params["page"]);		
            }else{
                $dataSet = $modelData->getOldDataByBlockIdAndPage($params["data_block_id"], $params["page"]);
            }
        }else{
            $dataSet = $modelData->getCurrentDataByBlockIdAndPage($params["data_block_id"], $params["page"]);
        }
	}

    $tplInfo = getRemoteHdInfo($params["tplname"]);

    $fileUrl = PROJECT_ROOT . "/application/templates/Smarty/Template/Block/hd-" . $params["tplname"]. ".tpl.htm";

    if($tplInfo){
	   file_put_contents($fileUrl , $tplInfo);
    }

    $smarty->assign("pagetitle", $dataSet[0]['content']['bankuaititle']);
	$smarty->assign("keywords", $dataSet[0]['content']['keywords']);
	$smarty->assign("description", $dataSet[0]['content']['description']);
    $smarty->assign("typeid", $dataSet[0]['content']['tag']);
    $text = $smarty->fetch($fileUrl);
    return preg_replace('!\s+!', ' ', $text);
}

//得到远程模板
function getRemoteHdInfo($name) 
{
    $url = "http://innerface.baofengweb/".$name;
    $ctx = stream_context_create(
        array( 'http' => array('timeout' => 2))
        );  
    return file_get_contents($url,0,$ctx);
}

