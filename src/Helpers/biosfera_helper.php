<?php


function json_clean_decode($json, $assoc = false, $depth = 512, $options = 0) {
    // search and remove comments like /* */ and //
    $data = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#", '', $json);
    
        return json_decode($data, $assoc);
    

    return $json;
}

/**
 * "engine_developer" => "BiosferaTech"
      "001_id" => "20190425194506"
      "650_keyword" => "GESTJUR"
      "653_index_term_uncontrolled" => "1. Gestão de Escritórios Jurídicos."
      "245a_title" => "CJF promove Encontro Nacional de Tecnologia da Informação da Justiça Federal"
      "245c_authority" => "Da Redação"
      "773d_date_lang" => "25 abr. 2019"
      "cover_long_url" => "http://192.168.25.8/mobile/img/long/20190425194506.jpg"
      "505_clippText" =>
 */
function call_format_helper_biosfera($data, $old)
{
    $body = extractArguments('body', $data);
    $data['origin'] = 'cloud_biosfera';
    $data['material_type'] = 'noticia_biosfera';
    $data['material_doc'] = 'clipping';
    $data['description'] = extractArguments('505_clippText', $body);
    $data['categories'] = preg_split("#,#", extractArguments('653_index_term_uncontrolled', $body));
    $data['tags'] =  preg_split("#,#", extractArguments('650_keyword', $body));
    addResume($data);
    addTumble($data, $old);
    addTimestamps($data, $old);
    $data['client_id']= 'modal.apps';
    return $data;
}



function addResume(&$data)
{
    $data['resume'] = str_limit($data['description'], 200) ;
}

function addTumble(&$data, $old)
{
    $data['tumble'] = sprintf("BIO%s", extractArguments('001_id', $old));
}
//20190425194506
function addTimestamps(&$data, $old)
{   
    $t = $old['001_id'];
    $published_at = sprintf("%s-%s-%s", 
       substr($t, 6, 2),
       substr($t, 4, 2),
       substr($t, 0, 4),
    );
    $timestamp_at = sprintf("%s %s:%s:%s",
       $published_at, 
       substr($t, -6, 2),
       substr($t, -4, 2),
       substr($t, -2, 2),
    );
    $data['published_at'] = $published_at;
    $data['timestamp'] = $timestamp_at;
    //$data['year'] = sprintf("BIO%s", extractArguments('001_id', $old));
}


function extractArguments($key, &$data)
{
    if( isset($data[$key])){
        $value = $data[$key];
        unset($data[$key]);
        return $value;
    }
}