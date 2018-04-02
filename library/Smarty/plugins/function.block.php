<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {block} function plugin
 *
 * Type:     function<br>
 * Name:     block<br>
 * Purpose:  实现页面可嵌入板块
 * @author wangxing
 * @param array parameters
 * @param Smarty
 * @return string|null
 */

define("IMG_DOMAIN", "zdy.bfimg.com");

function smarty_function_block($params, &$smarty)
{
    $params["page"] = $params["page"] > 0 ? $params["page"] : 1;
    $modelData = Publish_Model_Data::getInstance();
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

    //需要处理的图片字段
    $imgCols = array("img_url", "img_url_big", "img_url_small","big_img_url","small_img_url","url","img_url2");
    foreach ($dataSet as $key => $value){
        foreach($imgCols as $col){
            if ($value["content"][$col]) {
                //不是http开头,且是 img/8个数字/ 开头的地址
                if(!preg_match("/^http:\/\//", $value["content"][$col])  && preg_match("/^img\/\d{8}\//", $value["content"][$col])){
            	    $dataSet[$key]["content"][$col] = "http://" . IMG_DOMAIN . "/" . $value["content"][$col];
            	}
            }
        }
    }
    
	$modelTemplateBlock = Publish_Model_Template_Block::getInstance();
	$templateBlock = $modelTemplateBlock->findById($params["template_block_id"])->toArray();
	
//	print_r($templateBlock);
//	print_r($params);
	
	$fileUrl = PROJECT_ROOT . "/application/templates/Smarty/Template/Block/" . $params["template_block_id"] . "_" . $templateBlock["update_at"] . ".tpl.htm";
//	echo $fileUrl;exit;
	
	if(!file_exists($fileUrl)){
	    file_put_contents($fileUrl , $templateBlock["template"]);
	}
	//print_r($dataSet);
    $smarty->assign("items", $dataSet);
    $smarty->assign("params", $params);
    return $smarty->fetch($fileUrl);
}

