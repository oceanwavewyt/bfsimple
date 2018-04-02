<?php

/**
 * Smarty {playext} function plugin
 *
 * Type:     function<br>
 * Name:     playext<br>
 * Purpose:  查找播放资源的extension属性
 * @param array parameters
 * @param Smarty
 * @return string|null
 */
function smarty_function_playext($params, &$smarty)
{
	
	$wid = $params["wid"];
	$aid = isset($params["aid"])?$params["aid"]:"";
	$vid = isset($params["vid"])?$params["vid"]:"";
	
	$ext = $params["ext"];
	
    if ($wid && $vid){
    	$item = PlayResource_Model_Video::getInstance($wid)->findById($vid);
    }elseif ($wid && $aid){
    	$item = PlayResource_Model_Album::getInstance($wid)->findById($aid);
    }
    $item = $item->toArray();
    
    if ($item["extension"]){
    	$data = Zend_Json::decode($item["extension"]);
    }
	
    $source = array(
    	"category"=>"cctvCategory",
    	"resolution"=>"p2p_resolution"
    );
    $string = "";
    
    $extConfig = new Zend_Config_Ini ( '../application/Config/PlayResource.ini', $source[$ext] );
    $extConfig = $extConfig->$ext->toArray ();
    
//    $cctvCategoryConfig = new Zend_Config_Ini ( '../application/Config/PlayResource.ini', 'cctvCategory' );
//	$cctvCategoryConfig = $cctvCategoryConfig->category->toArray ();

//	foreach ($cctvCategoryConfig as $key=>$val){
//		if ($val["key"]==$data[$ext]){
//			$string.='<option value="'.$val["key"].'" selected="selected">'.$val["value"].'</option>';
//		}else{
//			$string.='<option value="'.$val["key"].'" >'.$val["value"].'</option>';
//		}
//		
//	}

    
	foreach ($extConfig as $key=>$val){
		if ($val["key"]==$data[$ext]){
			$string.='<option value="'.$val["key"].'" selected="selected">'.$val["value"].'</option>';
		}else{
			$string.='<option value="'.$val["key"].'" >'.$val["value"].'</option>';
		}
		
	}
    return $string;
    
}

