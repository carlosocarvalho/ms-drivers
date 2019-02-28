<?php

namespace Modalnetworks\MetaSearch\Entities\Noticias;

use Illuminate\Database\Eloquent\Model;

class RelationTerm extends Model
{
    protected $table = 'term_taxonomy';
    protected $connection = 'noticia_fiscal';
    public function term()
    {

        return $this->belongsTo(Term::class, 'term_id', 'term_id');
    }
}
