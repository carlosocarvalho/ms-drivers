<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 10/02/19
 * Time: 13:33
 */

namespace Modalnetworks\MetaSearch\Providers;


use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{


    public function __construct($app)
    {
        parent::__construct($app);
    }


    public function boot(){
         //$this->mergeConfigFrom(__DIR__ .'/../config/metasearch', 'metasearch');

         //$this->publishes([
          //   __DIR__ .'/../config/' => config_path()
        // ], 'metasearch.config');
    }



}