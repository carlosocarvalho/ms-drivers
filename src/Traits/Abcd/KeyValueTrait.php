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
    {
        $dataKeyValue = explode($this->keySeparator, trim($data));
        $value = (isset($dataKeyValue[1]) ? $dataKeyValue[1] : null);
        return (object)$this->getMappedKey($dataKeyValue[0], $value);
    }

    /**
     * @param $key
     * @return string
     */
    protected function getMappedKey($key, $value)
    {
        $keysOptions = $this->getSettingMapping()->fromMapping();
        $valuesOptions = $this->getSettingMapping()->toMapping();
        $keyIndex = array_search($key, $keysOptions);
        if ($keyIndex === false) return $this->validateKeyValue(($keyIndex == false && $this->strict === true ? null : $key), $value);
        return $this->hasCallbacks($valuesOptions[$keyIndex], $value);
    }

    protected function getOldKeyValue(string $data)
    {
        return  explode($this->keySeparator, trim($data));
    }

    /**
     * @param $key
     * @param $value
     * @return object
     */
    protected function hasCallbacks($key, $value)
    {
        if (is_string($key)) return $this->validateKeyValue($key, $value);
        if (isset($key['callbacks'])) {
            foreach ($key['callbacks'] as $callback) {
                $value = call_user_func($callback, $value);
            }
        }
        return $this->validateKeyValue($key['value'], $value);;
    }

    /**
     * @param null $key
     * @param $value
     * @return object
     */
    private function validateKeyValue($key = null, $value)
    {
        return (object)['key' => $key, 'value' => $value];
    }
}