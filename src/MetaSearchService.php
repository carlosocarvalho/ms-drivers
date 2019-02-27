<?php

namespace Modalnetworks\MetaSearch;


use Modalnetworks\MetaSearch\Contracts\MetaSearchDriverContract;

class MetaSearchService
{


    protected $driver;

    protected $remote;

    public function __construct()
    {
        $this->remote = new MetaSearchRemote();
    }

    public function driver(MetaSearchDriverContract $driver)
    {
        $this->driver = $driver;
        return $this;
    }

    public function pushRemote($data, \Closure $callback)
    {
        return $this->remote->push($this->getDriver()->data($data)->body(), $callback);
    }

    public function push()
    {

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