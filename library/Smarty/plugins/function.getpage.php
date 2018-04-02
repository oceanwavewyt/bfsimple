<?php
/**
 * Created by PhpStorm.
 * User: GaoQi
 * Date: 14-6-17
 * Time: 下午5:42
 * getpage方法
 * 获得指定页面的html代码
 * {getpage pageid=15 p=1}
 */

function smarty_function_getpage($params, &$smarty)
{
    $pageid = $params["pageid"];
    $p = $params["p"]?$params["p"]:1;

    //获得页面路径
    $modelTemplatePage = Publish_Model_Template_Page::getInstance();
    $where = $modelTemplatePage->quoteInto("id = ?",$pageid);
    $data = $modelTemplatePage->findAllArray($where,array("output_filename","url"));
    if(!empty($data)){
        $file = analyzePath($data[0],$pageid,$p);
        if(file_exists($file)){
            return file_get_contents($file);
        }else{
            return "<!-- 打开:[$file]文件不存在 页面id:[$pageid],页号:[$p] -->";
        }
    }else{
        return "<!-- 页面id:[$pageid]的页面不存在 -->";
    }
}

/**
 * 获得绝对物理路径
 * @param $row
 * @param $pageid
 * @param $p
 * @return string
 */
function analyzePath($row,$pageid,$p){
    if(strpos($row["output_filename"],"#")!== false){
        $paths = explode("#",$row["output_filename"]);
        $path = $paths[0];
        $index = $paths[1];
    }else{
        $path = $row["output_filename"];
        $index = "page_".$pageid;
    }
    if(is_dir($path)){
        $ext = substr(strrchr($row["url"], '.'), 1);
        return realpath($path) . "/".$index."_" . $p . "." . $ext;
    }else{
        return $row["output_filename"];
    }
}
