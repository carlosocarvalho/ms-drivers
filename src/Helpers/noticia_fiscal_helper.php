<?php


function get_categories_array($categories){
    if( ! is_array($categories) && !isset($categories['object_id'])) return $categories;
    $data = [];
    foreach ($categories as $categorie){
        $categorie_name = $categorie['intermed']['term']['name'];
        if( $categorie_name == null)
            continue;
        $data[] = $categorie_name;
    }
    return $data;
}

function extract_thumbnail($data){
    if( is_array($data)) return $data['guid'];
    return $data;
}


function add_extras_data($row, $old){


    $str = str_replace("\r",'', $row['description']);

    $resume = explode(PHP_EOL, $str);

    $resume = array_filter($resume, function ($row){
           if( $row != "") return strip_tags($row);
     });
    $resume = array_splice($resume,0,2);
    $row['resume'] = implode(PHP_EOL, $resume);
    $time = new \DateTime($row['published_at']);
    $row['year_at'] = $time->format('Y');
    return $row;
}