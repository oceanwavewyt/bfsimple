<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {getshare} function plugin
 *
 * Type:     function<br>
 * Name:     newcms<br>
 * Purpose:  获得影片是否分享微薄
 * @author gaoqi
 * @param array parameters
 * @param Smarty
 * @return string|null
 */
function smarty_function_getshare($params, &$smarty)
{
    $info = $params["params"];
    if(!class_exists(Mediadata_Constants)) include __DIR__.'/../../../application/modules/Mediadata/Constants.php';
    return Mediadata_Constants::getShare($info);
}

