<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 27/02/19
 * Time: 16:41
 */

namespace Modalnetworks\MetaSearch\Traits\NoticiaFiscal;


trait ParseRow
{

    /**
     * @param array $row
     * @return array
     */
    public function parseRow(array $row)
    {
        $data = [];
        foreach ($row as $key => $value) {
            $keyValue = $this->makeKeyValue($key, $value);
            if ($keyValue->key == null)
                continue;
            $data[$keyValue->key] = $keyValue->value;
        }
        if (!$data) {
            return $data;
        }
        $this->callbackDriver($data, $row);
        $settings = $this->getSettingMapping();
        $settings->setExtrasMerge(['driver' => $this->driverName]);
        $data = array_replace($data, $settings->getExtras());
        ksort($data, SORT_NATURAL);
        return $data;
    }
}