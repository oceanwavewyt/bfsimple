<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {rawurlencode} function plugin
 *
 * Type:     function<br>
 * Name:     rawurlencode<br>
 * Purpose:  rawurlencode
 * @author gaoqi
 * @param array parameters
 * @param Smarty
 * @return string|null
 */
function smarty_function_rawurlencode($params, &$smarty)
{
    $str = array_pop($params);
	return rawurlencode($str);
}

