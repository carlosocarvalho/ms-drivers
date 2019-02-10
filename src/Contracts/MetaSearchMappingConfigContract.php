<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 10/02/19
 * Time: 01:23
 */

namespace Modalnetworks\MetaSearch\Contracts;


interface MetaSearchMappingConfigContract
{
    public function toMapping();
    public function fromMapping();
}