<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 10/02/19
 * Time: 13:33
 */

namespace Modalnetworks\MetaSearch\Providers;


use Illuminate\Support\ServiceProvider;
use Modalnetworks\MetaSearch\MetaSearchMappingConfig;
use Modalnetworks\MetaSearch\MetaSearchService;

class LaravelServiceProvider extends ServiceProvider
{


    public function __construct($app)
    {
        parent::__construct($app);
    }


    public function boot(){
        $this->mergeConfigFrom( __DIR__.'/../config/metasearch.php', 'metasearch');

        $this->publishes([
            __DIR__.'/../config/' => config_path()
        ], 'metasearch.config');

        $this->initializeDefaults();
    }

    public function initializeDefaults(){


        $this->app->singleton(MetaSearchService::class, function (){
            $driver_mapping_default_name = config('metasearch.default_driver_load');
            $settings = new MetaSearchMappingConfig(config("metasearch.mappings.{$driver_mapping_default_name}"));
            $driver = config('metasearch.default_driver');
            return (new MetaSearchService())->driver( new $driver( $settings) );
        });



    }


}