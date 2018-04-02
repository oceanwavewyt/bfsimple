<?php

/**
 * Smarty {box_wc} function plugin
 *
 * Type:     function<br>
 * Name:     tips<br>
 * Purpose:  box播放传参
 * @param array parameters
 * @param Smarty
 * @return string|null
 */
function smarty_function_box_wc($params, &$smarty)
{
	$data = array();
	if (isset($params["wid"])){
		$data["Box_Type"] = "play";
		$data["wid"] = $params["wid"];
		if ($params["vid"]){
			$data["vid"] = $params["vid"];
		}else{
			$data["aid"] = $params["aid"];
		}
		$data["title"] = $params["title"];
	}
    return json_encode($data);
}

