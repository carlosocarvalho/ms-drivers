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

    protected $extrasMergedRow = [
        'driver' => 'abcd'
    ];
    public function __construct(array $mappingOptions )
    {
         $this->optionsFrom = array_keys($mappingOptions);
         $this->optionsTo = array_values($mappingOptions);
    }

    public function setExtrasMerge($data){
        $this->extrasMergedRow = array_merge($this->extrasMergedRow, $data);
        return $this;
    }

    public function getExtras(){
        return $this->extrasMergedRow;
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