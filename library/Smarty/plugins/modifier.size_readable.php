<?php
/**
 * Smarty size_readable modifier plugin
 *
 * Type:     modifier<br>
 * Name:     size_readable<br>
 * Date:     Apri 4, 2014
 * Purpose:  catenate a value to a variable
 * Input:    string to catenate
 * Example:  {$size_in_bytes|size_readable}
 *          
 * @author   lanzhiqiang@baofeng.com
 * @version 1.0
 * @param string
 * @return string
 */
function smarty_modifier_size_readable($size)
{
	$units = array(
		1099511627776 => 'TB',
		1073741824 => 'GB',
		1048576 => 'MB',
		1024 => 'KB',
	);
	
	foreach($units as $base => $unit) {
		if($size >= $base)
			return round($size / $base, 2) . $unit;
	}
	
	return $size . 'B';
}
