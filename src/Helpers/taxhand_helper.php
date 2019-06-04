<?php


if (!function_exists('extractTaxHandCategories')) {
    function extractTaxHandCategories($relatedTags)
    {
        $categories = [];
        foreach ($relatedTags as $cat) {
            $categories[] = $cat['displayName'];
        }

        return $categories;
    }
}


if (!function_exists('call_format_helper_taxhand')) {

    function call_format_helper_taxhand($data, $old)
    {
        addTumbleHand($data, $old);
        $data['client_id'] = 'modal.apps';
        $data['digital_type'] = 'online';
        $data['material_type'] = "taxalert";
        $data['material_doc'] = 'clipping';
        addTaxHandTimestamps($data, $old);
        return $data;
    }
}


function addTumbleHand(&$data, $old)
{
    $data['tumble'] = sprintf("TAXHAND%s", extractArguments('uuid', $old));
}

function addTaxHandTimestamps(&$data, $old)
{
    $date = new \DateTime(strtotime($data['published_at']));
    $data['published_at'] = $date->format('Y-m-d');
    $data['timestamp'] = $date->format('Y-m-d H:i:s');
}