<?php
function smarty_modifier_cn_truncate($string, $length = 80, $etc = '...',$strip_tags = false,$allowable_tags="")
{
    if ($length == 0)
        return '';
    if($strip_tags){
    	$string = strip_tags($string,$allowable_tags);
    }    
    
	return substr_utf8($string, 0, $length, $etc);
}


function substr_utf8( $str, $start=0, $length, $suffix = '...' )
{
    // 字符串完整的长度
    $str_full_len = (strlen($str) + mb_strlen($str, 'UTF8')) / 4;
    // 若字符串长度在范围内，取消后缀
    $str_full_len <= $length && $suffix = '';
    // 若字符串长度超出范围，则加上对suffix 长度的考虑，修正实际需要截取的长度
    $str_full_len > $length && $length = $length - ~~ ( (strlen($suffix) + mb_strlen($suffix, 'UTF8')) / 4 );
    // 截取处理
    $strlenth    = 0;
    $output      = '';
    preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/", $str, $match);
    foreach($match[0] as $v){
        preg_match("/[\xe0-\xef][\x80-\xbf]{2}/",$v, $matchs);
        if(!empty($matchs[0])){
            $strlenth   +=  1;
        }elseif(is_numeric($v)){
            //$strlenth +=  0.545;  // 字符像素宽度比例 汉字为1
            $strlenth   +=  0.5;    // 字符字节长度比例 汉字为1
        }else{
            //$strlenth +=  0.475;  // 字符像素宽度比例 汉字为1
            $strlenth   +=  0.5;    // 字符字节长度比例 汉字为1
        }

        if ($strlenth > $length) {
            $output .= $suffix;
            break;
        }

        $strlenth >= $start && $output .= $v;
    }
    return $output;
}
?>