<?php

namespace Modalnetworks\MetaSearch\Entities\Noticias;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $connection = 'noticia_fiscal';
    protected $table = 'terms';
}
