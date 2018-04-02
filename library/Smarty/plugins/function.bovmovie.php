<?php

/**
 * @param $params array('movie'=>array(), 'url_postfix'=>'7C/7Cchannel/3Dbov/7C/7Cpid/3Dbov')
 * @param $smarty
 * @return string
 */
function smarty_function_bovmovie($params, &$smarty) {
    $movie = $params['movie'];
    $movieid = $movie['movieid'];
    $url_postfix = $params['url_postfix'];
    $title = htmlentities($movie['title']);
    $url = $movie['album']['storm_short'] . $url_postfix;
    $detail = array('movieid'=>$movieid, 'pid'=>$movie['bov']);
    if ($movie['album']['hd_type'] == '1080P') $detail['format'] = 1;
    else if ($movie['album']['hd_type'] == '720P') $detail['format'] = 2;
    else if ($movie['album']['hd_type'] == '480P') $detail['format'] = 3;
    else $detail['format'] = 0;
    $video_count = 0;
    if (isset($movie['albumn']['videos'])) {
        $video_count = count($movie['albumn']['videos']);
    }
    $detail = json_encode($detail);
    $hot = $movie['movie_click'];
    $score = $movie['score'];
    $cc = $movie['commentcount'];
    $poster = "";
    $base_url = "http://box.bfimg.com/";
    if ($movie['wid'] != 13 && isset($movie['images'][51])) {
        $poster = $base_url . $movie['images'][51];
    } else if ($movie['wid'] == 13) {
        $poster = $base_url . '/img/' .( $movieid % 500) . '/' . $movieid . '/91_96*128.jpg';
    }
    $actors = array();
    $directors = array();
    foreach ($movie['people'] as $p) {
        if ($p['typeid'] == 3 && count($actors) < 3) {
            $actors[] = htmlentities($p['name']);
        } else if ($p['typeid'] == 1) {
            $directors[] = htmlentities($p['name']);
        }
    }
    $actors = implode(' ', $actors);
    $directors = implode(' ', $directors);
    $result = "<movie name=\"{$title}\" url=\"{$url}\" detail='{$detail}' actors=\"{$actors}\" hot=\"{$hot}\" score=\"{$score}\" cc=\"{$cc}\" director=\"{$directors}\" desc=\"\" video_count=\"{$video_count}\" poster=\"{$poster}\" />";
    return $result;
}