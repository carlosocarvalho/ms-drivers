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


     public function __construct(MetaSearchMappingConfigContract $settings)
     {
         $this->settings = $settings;

     }

     public function data( string $str){
          $this->data = $str;
          return $this;
     }
     public function body()
     {
        return  $this->makeRow() ;
     }

    /**
     * @return MetaSearchMappingConfigContract
     */
     protected function getSettingMapping(){
         return $this->settings;
     }



}