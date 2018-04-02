<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty cat modifier plugin
 *
 * Type:     modifier<br>
 * Name:     htmlentities<br>
 * Date:     Feb 24, 2003
 * Example:  {$var|htmlentities}
 * @link http://smarty.php.net/manual/en/language.modifier.htmlentities.php cat
 *          (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @version 1.0
 * @param string
 * @return string
 */
function smarty_modifier_htmlentities($string)
{
    return htmlentities($string,ENT_COMPAT,'UTF-8');
}

/* vim: set expandtab: */

?>
