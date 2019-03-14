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
        $old = [];
        $data = [];
        array_map(function ($item) use (&$data, &$old) {
            $keyValue = $this->makeKeyValue($item);
            $origin = $this->getOldKeyValue($item);
            $old[(string) $origin[0]] = isset($origin[1]) ? $origin[1] : null;

            if ($keyValue->key !== null) {
                $data[$keyValue->key] = $keyValue->value;
            }
        }, $row);
        $this->callbackDriver($data, $old);
        $settings = $this->getSettingMapping();
        $settings->setExtrasMerge(['driver' => $this->driverName]);
        $data = array_replace($data, $settings->getExtras());
        ksort($data, SORT_NATURAL);
        return $data; //array_replace($data, $this->getSettingMapping()->getExtras());
    }
}
