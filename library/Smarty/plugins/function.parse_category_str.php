<?php
/*
 *
 * @param $params['category_str'] 分类串
 * @param $params['assign'] 赋值的模板变量
 * @return array
 */
function smarty_function_parse_category_str($params, &$smarty)
{
    $res = array();
    if ( trim( $params['category_str'] ) ) {
        $category_arr = explode( ',', $params['category_str'] );

        if ( $type = explode( '-', $category_arr[0] ) ) {
            $res['typeid'] = (int) $type[0];
            $res['typename'] = trim( (string) $type[1] );
        }

        if ( $area = explode( '-', $category_arr[1] ) ) {
            $res['areaid'] = (int) $area[0];
            $res['area'] = trim( (string) $area[1] );
        }

        if ( $category = explode( '-', $category_arr[2] ) ) {
            $res['categoryid'] = (int) $category[0];
            $res['category'] = trim( (string) $category[1] );
        }
    }

    if (!empty($params['assign'])) {
        $smarty->assign($params['assign'], $res);
    } else {
        return $res;
    }
}
