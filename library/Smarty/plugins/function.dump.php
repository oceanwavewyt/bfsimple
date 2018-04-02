<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {dump} function plugin
 *
 * Type:     function<br>
 * Name:     dump<br>
 * Purpose:  Zend_Debug::dump
 * @author wangxing
 * @param array parameters
 * @param Smarty
 * @return string|null
 */
function smarty_function_dump($params, &$smarty)
{
    Zend_Debug::dump(array_pop($params));
}

