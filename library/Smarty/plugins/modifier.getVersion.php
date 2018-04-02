<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty 暴高清得到最新版本号
 *
 * Type:     modifier<br>
 * Name:     getVersion<br>
 * Purpose:  从暴高清服务器上获取最新版本号
 * Example:  {$var|getVersion}
 * Date:     April, 2013
 */
function smarty_modifier_getVersion($text)
{	
	$verUrl = "http://innerface.baofengweb/lastversion.record";
	//超时设置
    $ctx = stream_context_create(
        array( 'http' => array('timeout' => 2))
        );  	
	$ver = file_get_contents($verUrl,0,$ctx);
	//异常情况下，随机生成
	if(!$ver)
	{
		$ver = substr(time(),-4);
	}
	return trim($text."=".$ver);
}
?>
