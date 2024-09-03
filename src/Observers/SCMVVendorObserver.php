<?php
 
namespace Rahat1994\SparkcommerceMultivendor\Observers;
 
use App\Models\User;
use Filament\Facades\Filament;
use Rahat1994\SparkCommerce\Models\SCCategory;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVVendor;
 
class SCMVVendorObserver
{
        /**
     * Handle the vendor "deleting" event.
     */
    public function deleting(SCMVVendor $vendor): void
    {
        $vendor->members()->detach();
    }

    public function deleted(SCMVVendor $vendor): void
    {
        $vendor->sCProducts()->delete();
        $vendor->sCCategories()->delete();
        $vendor->SCCoupons()->delete();
    }

    public function created(SCMVVendor $vendor): void
    {
        $vendor->sCCategories()->create([
            'name' => 'Uncategorized'
        ]);
    }


}