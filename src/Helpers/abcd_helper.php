<?php


/**
 * @param $str
 * @return array
 */
function abcd_explode_values($str){
    return explode(';', $str);
}


/**
 * @param $link
 * @return string
 *
 */
function clear_slashes_links($link){
    if( ! filter_var($link, FILTER_VALIDATE_URL)) return $link;
    $linkArray = preg_split('#://#', $link);
    return  implode('', [$linkArray[0], '://', str_replace('//', '/', $linkArray[1]) ]);
}


function abcd_format_date($data){
    if( strlen($data) == 8){
        return substr($data, 0, 4). '-' .substr($data, 4, 2).'-'.substr($data, 6);
    }

    return date('Y-m-d');
}