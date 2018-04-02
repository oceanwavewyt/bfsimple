<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {incblock   template_block_id=""  data="$row"}  function plugin
 *
 * Type:     function<br>
 * Name:     incblock<br>
 * Purpose:  实现页面可嵌入板块
 * @author wangyutian
 * @param array parameters
 * @param Smarty
 * @return string|null
 */

function smarty_function_incblock($params, &$smarty)
{
    if(!isset($params['data']) || !is_array($params['data'])) {
        $params['data'] = array();
    }

    $modelTemplateBlock = Publish_Model_Template_Block::getInstance();
    $templateBlock = $modelTemplateBlock->findById($params["template_block_id"])->toArray();

    $fileUrl = PROJECT_ROOT . "/application/templates/Smarty/Template/Block/" . $params["template_block_id"] . "_" . $templateBlock["update_at"] . ".tpl.htm";

    if(!file_exists($fileUrl)){
        file_put_contents($fileUrl , $templateBlock["template"]);
    }
    $smarty->assign("data", $params['data']);
    return $smarty->fetch($fileUrl);
}

