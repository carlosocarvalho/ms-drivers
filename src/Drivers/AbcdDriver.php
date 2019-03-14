<?php
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

    protected $keySeparator = '|';

    protected $driverName = 'abcd';

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
    public function data($str = null)
    {
        $this->data = $str != null ? $str : $this->data;
        return $this;
    }

    /**
     * @return array
     */
    public function body()
    {
        return $this->makeRow();
    }

    /**
     * @return MetaSearchMappingConfigContract
     */
    protected function getSettingMapping()
    {
        return $this->settings;
    }


    public function boostrap($settings = [])
    {
        return $this;
    }

    private function callbackDriver(&$row, $old)
    {

        $callbacks = $this->settings->getOptions()['callbacks_drivers'];
        if (!isset($callbacks[$this->driverName]) or !$callbacks[$this->driverName]) return;

        foreach ($callbacks[$this->driverName] as $callback) {
            $row = call_user_func($callback, $row, $old);
        }
    }
}