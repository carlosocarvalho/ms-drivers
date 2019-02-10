<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 10/02/19
 * Time: 01:43
 */

namespace Modalnetworks\MetaSearch\Traits\Abcd;


trait KeyValueTrait
{

    /**
     * @param string $data
     * @return object
     */
    public function makeKeyValue(string $data)
    {   $dataKeyValue = explode($this->keySeparator, trim($data));
        return (object) [ 'key' =>  $this->getMappedKey($dataKeyValue[0]) , 'value' => (isset($dataKeyValue[1]) ?  $dataKeyValue[1]: null)];
    }

    /**
     * @param $key
     * @return string
     */
    protected function getMappedKey($key){
        $keysOptions = $this->getSettingMapping()->fromMapping();
        $valuesOptions = $this->getSettingMapping()->toMapping();
        $keyIndex = array_search( $key, $keysOptions);
        if($keyIndex === false) return $key;
        return $valuesOptions[$keyIndex];
    }
}