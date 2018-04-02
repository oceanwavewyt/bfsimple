<?php
function smarty_function_index_json($params,&$smarty )
{
	$arr=$params['params'];
	$type=$params['type'];
	$num=count($arr);
	$tmp=array();
	for ($i=0;$i<$num;$i++)
	{
		if ($arr[$i]['content']['type']=='play') {
			$tmp[$i]['movieid']=$arr[$i]['content']['movieid'];
			$tmp[$i]['title']=$arr[$i]['content']['title'];
			$tmp[$i]['wid']=$arr[$i]['content']['wid'];
			$tmp[$i]['aid']=$arr[$i]['content']['aid'];
			if ($type=='top') {// top 首页顶部轮番 其他为首页 bottom
				$tmp[$i]['brief']=$arr[$i]['content']['movie_gut'];
			}
			if (stripos($arr[$i]['content']['img'],'http:') === false)//判断图片
			$tmp[$i]['img']="http://zdy.bfimg.com/".$arr[$i]['content']['img'];
			else
			$tmp[$i]['img']=$arr[$i]['content']['img'];
		}
	}
	unset($arr);
	
	return json_encode($tmp);
}

?>