<?php

namespace Rahat1994\SparkcommerceMultivendor\Models;

use App\Models\User;
use Arr;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Rahat1994\SparkCommerce\Models\SCCategory;
use Rahat1994\SparkCommerce\Models\SCCoupon;
use Rahat1994\SparkCommerce\Models\SCProduct;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class SCMVVendor extends Model implements HasMedia
{
    use Sluggable, InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'meta',
        'user_id',
        'slug',
        'category',
        'address',
        'contact_number',
    ];

    protected $casts = [
        'name' => 'string',
        'meta' => 'array',
        'category' => 'array',
        'user_id' => 'integer',
    ];

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return config('sparkcommerce-multivendor.table_prefix') . 'vendors';
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'sc_mv_user_vendor', 'vendor_id', 'user_id');
    }

    public function sCProducts()
    {
        return $this->hasMany(SCProduct::class, 'vendor_id', 'id');
    }

    public function sCCategories()
    {
        return $this->hasMany(SCCategory::class, 'vendor_id', 'id');
    }

    public function SCCoupons()
    {
        return $this->hasMany(SCCoupon::class, 'vendor_id', 'id');
    }

    // public function scmvShopCategory()
    // {
    //     $this->belongsTo(SCMVShopCategory::class, 'category', 'id');
    // }

    public function getMetaValue($key, $default = null)
    {
        return Arr::get($this->meta, $key, $default);
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
