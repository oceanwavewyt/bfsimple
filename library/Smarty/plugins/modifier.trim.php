<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty plugin
 *
 * Type:     modifier<br>
 * Name:     trim<br>
 * Date:     Feb 26, 2003
 * Example:  {$text|trim}
 * @version  1.0
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @return string
 */
function smarty_modifier_trim($string)
{
    return trim($string);
}

/* vim: set expandtab: */

?>
