<?php

namespace Rahat1994\SparkcommerceMultivendor\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Rahat1994\SparkCommerce\Models\SCProduct;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class SCMVAdvertisement extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'url',
        'impressions',
        'clicks',
        'user_id',
        'meta',
        'position',
        'contact_number',
    ];

    protected $casts = [
        'name' => 'string',
        'meta' => 'array'
    ];

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return config('sparkcommerce-multivendor.table_prefix') . 'advertisements';
    }
}
