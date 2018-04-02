<?php
/*
 *
 * @param $params['array'] 二维数组
 * @param $params['key'] 指定二维数组的子数组的某个key
 * @return array
 */
function smarty_function_get_sub_by_key($params, &$smarty)
{
    $res = array();
    foreach ( $params['array'] as $v ) {
    	$res[] = isset( $v[$params['key']] ) ? $v[$params['key']] : '';
    }

    if (!empty($params['assign'])) {
        $smarty->assign($params['assign'], $res);
    } else {
        return $res;
    }
}
