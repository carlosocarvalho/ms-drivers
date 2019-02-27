<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 27/02/19
 * Time: 13:20
 */

namespace Modalnetworks\MetaSearch\Entities\Noticias;


use Illuminate\Database\Eloquent\Model;

class RelationTerm extends  Model
{
    protected $table = 'term_taxonomy';

    public function term(){

        return $this->belongsTo(Term::class,'term_id','term_id');
    }
}