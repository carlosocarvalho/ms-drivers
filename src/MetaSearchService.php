<?php

namespace Modalnetworks\MetaSearch;


use Modalnetworks\MetaSearch\Contracts\MetaSearchDriverContract;

class MetaSearchService
{


    protected $driver;

    protected $remote;

    public function __construct(MetaSearchDriverContract $driver )
    {
        $this->driver = $driver;
        $this->remote = new MetaSearchRemote();
    }

    public function pushRemote(\Closure $callback){
       return $this->remote->push( $this->getDriver()->body(), $callback);
    }

    public function push(){

    }


    protected function getDriver(){
        return $this->driver;
    }


    protected function registeredDrivers(){


    }
}