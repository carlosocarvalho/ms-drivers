<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 27/02/19
 * Time: 09:32
 */

namespace Modalnetworks\MetaSearch\Drivers;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Modalnetworks\MetaSearch\Contracts\MetaSearchDriverContract;
use Modalnetworks\MetaSearch\Contracts\MetaSearchMappingConfigContract;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Modalnetworks\MetaSearch\Entities\Noticias\Post;
use Modalnetworks\MetaSearch\Traits\NoticiaFiscal\KeyValueTrait;
use Modalnetworks\MetaSearch\Traits\NoticiaFiscal\ParseRow;

class NoticiaFiscalDriver implements MetaSearchDriverContract
{
    use KeyValueTrait;
    use ParseRow;

    protected $driverName = 'noticia_fiscal';
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
        $posts = new Post();
        $data = $posts->onlyPost()->ofDay()->get();
        $this->bulk($data);
        return $this->data;
    }


    public function boostrap($settings = [])
    {

        $capsule = new Capsule;
        $capsule->addConnection($settings, 'noticia_fiscal');
        $capsule->setEventDispatcher(new Dispatcher(new Container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

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
    private function bulk(Collection $data)
    {
        $dataMaked = [];
        $data->each(function ($row) use (& $dataMaked) {
            $dataRow = $this->parseRow($row->toArray());
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