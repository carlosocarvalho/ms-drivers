<?php

namespace Modalnetworks\MetaSearch;

use Modalnetworks\MetaSearch\Contracts\MetaSearchDriverContract;

/**
 * Class MetaSearchService
 * @package Modalnetworks\MetaSearch
 */
class MetaSearchService
{

    /**
     * @var
     */
    protected $driver;
    /**
     * @var MetaSearchRemote
     */
    protected $remote;

    public function __construct()
    {
        $this->remote = new MetaSearchRemote();
    }

    /**
     * @param MetaSearchDriverContract $driver
     * @return $this
     */
    public function driver(MetaSearchDriverContract $driver)
    {
        $this->driver = $driver;
        return $this;
    }

    /**
     * @param $data
     * @param \Closure $callback
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function pushRemote($data = null, \Closure $callback)
    {
        return $this->remote->push($this->getDriver()->data($data)->body(), $callback);
    }

    /**
     * @param null $data
     * @param \Closure $callback
     * @throws \Exception
     */
    public function pushLocal($data = null, \Closure $callback)
    {
        $callback($this->getDriver()->data($data)->body());
    }

    /**
     * @return MetaSearchDriverContract
     * @throws \Exception
     */
    protected function getDriver()
    {
        if ($this->driver){
            return $this->driver;
        }
        throw new \Exception('Driver undefined');
    }


    protected function registeredDrivers()
    {


    }
}