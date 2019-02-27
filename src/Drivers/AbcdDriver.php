<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 09/02/19
 * Time: 12:27
 */

namespace Modalnetworks\MetaSearch\Drivers;


use Modalnetworks\MetaSearch\Contracts\MetaSearchDriverContract;
use Modalnetworks\MetaSearch\Contracts\MetaSearchMappingConfigContract;
use Modalnetworks\MetaSearch\Traits\Abcd\KeyValueTrait;
use Modalnetworks\MetaSearch\Traits\Abcd\MappingTrait;
use Modalnetworks\MetaSearch\Traits\Abcd\RowTrait;

class AbcdDriver implements MetaSearchDriverContract
{
    use KeyValueTrait, RowTrait, MappingTrait;

    protected $data;

    protected $settings;

    protected $dataSeparator = '||';

    protected $keySeparator =  '|';

    protected $driverName = 'Abcd';

    /**
     * @var bool
     */
    protected $strict = false;

    public function __construct(MetaSearchMappingConfigContract $settings, $strict = false)
    {
        $this->settings = $settings;
        $this->strict = $strict;

    }

    /**
     * @param string $str
     * @return $this
     */
    public function data( string $str = null){
        $this->data =  $str != null ? $str : $this->data;
        return $this;
    }

    /**
     * @return array
     */
    public function body()
    {
        return  array_replace($this->makeRow(), $this->getSettingMapping()->getExtras());
    }

    /**
     * @return MetaSearchMappingConfigContract
     */
    protected function getSettingMapping(){
        return $this->settings;
    }



}