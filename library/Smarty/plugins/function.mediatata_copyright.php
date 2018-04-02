<?php

/**
 * Smarty {tips} function plugin
 *
 * Type:     function<br>
 * Name:     mediadata_copyright<br>
 * Purpose:  实现查找版权关联信息功能
 * @param array parameters
 * @param Smarty
 * @return string|null
 */
function smarty_function_mediadata_copyright($params, &$smarty)
{
	
	$mode = $params["mode"];
    $params = $params["params"];
    $movieid = $params["movieid"];

    $string = "";
    switch ($mode){
    	case "title":
    		$string = Mediadata_Model_Movie::getInstance()->getTitleByMovieid($movieid);
    		break;
      	case "typeid":
    		$array = PlayInfoCategory_Model_CategoryRelation::getInstance()->getCategoryRelationbyMovieid($movieid);
    		$string = PlayInfoCategory_Model_Type::getInstance()->getNameByTypeid($array[0]["typeid"]);
    		break;
    	case "areaid":
    		$array = PlayInfoCategory_Model_CategoryRelation::getInstance()->getCategoryRelationbyMovieid($movieid);
    		$string = PlayInfoCategory_Model_Type::getInstance()->getNameByAreaid($array[0]["areaid"]);
    		break;
    		
    }
    return $string;
}

