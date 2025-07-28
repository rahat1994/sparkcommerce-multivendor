<?php

namespace Rahat1994\SparkcommerceMultivendor\Models;

use Illuminate\Database\Eloquent\Model;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVVendor;
class SCMVPayoutRequest extends Model
{
    protected $fillable = [
        'amount',
        'bank_info',
        'vendor_id',
        'status',
        'meta',
    ];

    protected $casts = [
        'bank_info' => 'array',
        'meta' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return config('sparkcommerce-multivendor.table_prefix') . 'payment_requests';
    }

    public function sCMVVendor()
    {
        return $this->belongsTo(SCMVVendor::class, 'vendor_id', 'id');
    }

    protected static function booted(): void
    {
        static::creating(fn ($payoutRequest) => self::turnAmountIntoCents($payoutRequest));
        static::updating(fn ($payoutRequest) => self::turnAmountIntoCents($payoutRequest));

        static::retrieved(function (SCMVPayoutRequest $payoutRequest) {
            $payoutRequest->amount = $payoutRequest->amount / (int) config('sparkcommerce.decimal_value');
        });
    }

    protected static function turnAmountIntoCents(SCMVPayoutRequest $payoutRequest)
    {
        $payoutRequest->amount = $payoutRequest->amount * (int) config('sparkcommerce.decimal_value');
    }

}
