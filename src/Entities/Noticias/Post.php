<?php

namespace Modalnetworks\MetaSearch\Entities\Noticias;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $connection = 'noticia_fiscal';


    public function scopeOfDay($q)
    {
        return $q->whereBetween('post_modified', [date('Y-m-27 00:00:00'), date('Y-m-d 23:59:59')]);
    }

    public function scopeOrderDay($q)
    {
        return $q->orderBy('post_date', 'desc');
    }

    public function scopeOnlyPost($query)
    {
        return $query
            ->with(['categories.intermed.term' => function ($query) {
                return $query->where('slug', '<>', 'capa');
            }, 'thumbnail'])
            ->where('post_type', '=', 'post')
            ->where('post_status', '=', 'publish')
            ->orderBy('post_modified', 'DESC');
    }

    public function categories()
    {
        return $this->hasMany(RelationPost::class, 'object_id', 'ID');
    }
    public function intermed()
    {

        return $this->belongsToMany(
            RelationPost::class,
            'terms',
            'term_id',
            'term_id',
            'term_taxonomy_id',
            'term_taxonomy_id',
            'object_id'
        );
    }

    public function thumbnail()
    {

        return $this->hasOne(Post::class, 'post_parent', 'ID')->where('post_type', 'attachment');
    }
}
