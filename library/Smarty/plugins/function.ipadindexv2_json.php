<?php
function smarty_function_ipadindexv2_json($params,&$smarty ) 
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
			$tmp[$i]['vid']=$arr[$i]['content']['vid'];
			$tmp[$i]['volume']=$arr[$i]['content']['volume'];
			 //dzone 判断
			if ($tmp[$i]['wid']==13) {
				$tmp[$i]['dzone']=Ipad_Model_Ipadv2::indexAction($arr[$i]['content']['aid']);
			}else {
				$tmp[$i]['dzone']=0;
			}
			if ($type=='top') {// top 首页顶部轮番 其他为首页 bottom
				$tmp[$i]['brief']=$arr[$i]['content']['movie_gut'];
				
			}
			if ($type=='bottom') {// bottom typeid
				$tmp[$i]['typeid']=$arr[$i]['content']['typeid'];
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