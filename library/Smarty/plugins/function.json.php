<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {json} function plugin
 *
 * @param $params parameters
 * @param Smarty
 * @return string|null
 */
function smarty_function_json($params, &$smarty) {
    return json_encode($params['array']);
}

