<?php

namespace Rahat1994\SparkcommerceMultivendor\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SCMVShopCategory extends Model implements HasMedia
{
    use Sluggable, InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'order',
        'meta',
        'user_id',
    ];

    protected $casts = [
        'name' => 'string',
        'user_id' => 'integer',
    ];

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return config('sparkcommerce-multivendor.table_prefix') . 'shop_categories';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
}
