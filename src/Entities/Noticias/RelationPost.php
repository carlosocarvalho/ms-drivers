<?php

namespace Modalnetworks\MetaSearch\Entities\Noticias;

use Illuminate\Database\Eloquent\Model;

class RelationPost extends  Model
{
    protected $table = 'term_relationships';

    public function intermed(){

        return $this->belongsTo(RelationTerm::class,'term_taxonomy_id','term_taxonomy_id');
    }
}