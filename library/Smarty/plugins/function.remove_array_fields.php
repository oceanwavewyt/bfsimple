<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty truncate modifier plugin
 *
 * Type:     modifier<br>
 * Name:     truncate<br>
 * Purpose:  Remove the specify fields of array,and return json string,
			 for win8.
 * @author   wangyutian
 * @param $params 
 * {remove_array_fields  array=$items needs="movieid,wid,aid,vid,title,img,brief"}
 */
function smarty_function_remove_array_fields($params, &$smarty)
{

        $needarr = explode(',', $params['needs']);
        $arrs = $params['array'];
        $ret = array();
        foreach($arrs as $k=>$arr)
        {
			foreach($needarr as $key)
            {
				if(!isset($arr['content'][$key])) continue;
                $ret[$k][$key] = $arr['content'][$key];
            }
        }
        return json_encode($ret);
}

/* vim: set expandtab: */

?>
