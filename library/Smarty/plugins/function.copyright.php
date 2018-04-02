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
function smarty_function_copyright($params, &$smarty)
{
	$etc = $params["params"];
	$mode = $params["mode"];
    $movieid = $etc["movieid"];

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
    		$string = PlayInfoCategory_Model_Area::getInstance()->getNameByAreaid($array[0]["areaid"]);
    		break;
    		
    		//<span style="color:#C60"></span>
		case "danger":
    		if ($etc["danger_status"]>0){
    			$string = "<span style='color:#f00'>LV</span>";
    		}else{
    			$string = "<span style='color:#00f'>LA</span>";
    		}
    		break;
    	case "company":
    		if ($etc["company_id"] && $etc["copyright_end_time"]){
    			if ((time()-$etc["copyright_end_time"])>0){
    				$string = "<span style='color:#00f'>有</span>,<span style='color:#F6C'>已过期</span>";
    			}else{
    				$string = "<span style='color:#00f'>有</span>,<span style='color:#00f'>未过期</span>";
    			}
    		}else{
    			$string = "<span style='color:#966'>无</span>";
    		}
    		break;
    	case "user":
    		if ($etc["copyright_userid"]){
	    		$userInfo = Acl_Model_Users::getInstance()->findById($etc["copyright_userid"]);
	    		$string = $userInfo->username;
    		}else{
    			$string = "未知";
    		}
    		break;    	
    	case "user_update":
    		if ($etc["copyright_userid_update"]){
	    		$userInfo = Acl_Model_Users::getInstance()->findById($etc["copyright_userid_update"]);
	    		$string = $userInfo->username;
    		}else{
    			$string = "未知";
    		}
    		break;    		
    }
    return $string;
}

