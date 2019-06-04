<?php
namespace Modalnetworks\MetaSearch\Drivers;

use Modalnetworks\MetaSearch\Contracts\MetaSearchDriverContract;
use Modalnetworks\MetaSearch\Contracts\MetaSearchMappingConfigContract;
use Modalnetworks\MetaSearch\Entities\Deloitte\TaxHand as Clipping;
use Modalnetworks\MetaSearch\Traits\Base\KeyValueTrait;
use Modalnetworks\MetaSearch\Traits\Base\ParseRow;


class TaxHandDeloitteDriver implements MetaSearchDriverContract
{
    use KeyValueTrait;
    use ParseRow;

    protected $driverName = 'taxhand';
    /**
     * @var MetaSearchMappingConfigContract
     */
    protected $settings;

    /**
     * @var bool
     */
    protected $strict;

    /**
     * @var array
     */
    protected $data;

    public function __construct(MetaSearchMappingConfigContract $config, $strict = false)
    {
        $this->settings = $config;
        $this->strict = $strict;
    }

    public function body()
    {
        //$posts = new Post();
        //$data = $posts->onlyPost()->ofDay()->get();
        $data = Clipping::all();
        $this->bulk($data);
        return $this->data;
    }


    public function boostrap($settings = [])
    {

        return $this;
    }

    public function data($data = null)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return MetaSearchMappingConfigContract
     */
    protected function getSettingMapping()
    {
        return $this->settings;
    }

    /**
     * @param Model $data
     */
    private function bulk($data)
    {
        $dataMaked = [];
        $data->each(function ($row) use (&$dataMaked) {
            $dataRow = $this->parseRow($row);
            if ($dataRow)
                $dataMaked[] = $dataRow;
        });
        $this->data = $dataMaked;
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
