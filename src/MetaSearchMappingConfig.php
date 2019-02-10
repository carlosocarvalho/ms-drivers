<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 10/02/19
 * Time: 01:23
 */

namespace Modalnetworks\MetaSearch;


use Modalnetworks\MetaSearch\Contracts\MetaSearchMappingConfigContract;

class MetaSearchMappingConfig implements MetaSearchMappingConfigContract
{
    protected $optionsFrom = [];
    protected $optionsTo = [];
    public function __construct(array $mappingOptions )
    {
         $this->optionsFrom = array_keys($mappingOptions);
         $this->optionsTo = array_values($mappingOptions);
    }

    /**
     * @return array
     */
    public function fromMapping(){
        return $this->optionsFrom;
    }

    /**
     * @return array
     */
    public function toMapping(){
        return $this->optionsTo;
    }
}