<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 10/02/19
 * Time: 01:33
 */

namespace Modalnetworks\MetaSearch\Traits\Abcd;


trait RowTrait
{


    public function makeRow()
    {

        $row = explode($this->dataSeparator, trim($this->data, $this->dataSeparator));
        $data = [];
        array_map( function($item) use (& $data){
            $keyValue = $this->makeKeyValue($item);

            if( $keyValue->key !== null)
               $data[$keyValue->key] = $keyValue->value;
        },$row);
        return $data; //array_replace($data, $this->getSettingMapping()->getExtras());


    }

}