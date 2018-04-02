<?php
/*
 *
 * @param $params['movieid'] movieID
 * @param $params['assign'] 赋值的模板变量
 * @return array
 */
function smarty_function_get_movie_info($params, &$smarty)
{
	static $memcache = null;

	if ( ! isset( $memcache ) ) {
		$memcache = new Memcache();
        $memcache->connect( '127.0.0.1', 12100 );
	}

    $res = json_decode( $memcache->get( $params['movieid'] ), true );

    if (!empty($params['assign'])) {
        $smarty->assign($params['assign'], $res);
    } else {
        return $res;
    }
}
