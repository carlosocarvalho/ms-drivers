<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 27/02/19
 * Time: 15:24
 */

namespace Modalnetworks\MetaSearch\Traits\Base;


trait KeyValueTrait
{
    /**
     * @param string $data
     * @return object
     */
    public function makeKeyValue($key, $value)
    {
        return (object)$this->getMappedKey($key, $value);
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

    /**
     * @param $key
     * @param $value
     * @return object
     */
    protected function hasCallbacks($key, $value)
    {
        if (is_string($key)) return $this->validateKeyValue($key, $value);
        if (isset($key['callbacks'])  && $key['callbacks']) {
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