<?php
 
namespace Rahat1994\SparkcommerceMultivendor\Observers;
 
use App\Models\User;
use Filament\Facades\Filament;
use Rahat1994\SparkCommerce\Models\SCCategory;
 
class SCProductCategoryObserver
{
    /**
     * Handle the User "created" event.
     */
    public function creating(SCCategory $category): void
    {
        // dd(Filament::getTenant());
        if (Filament::getTenant() === null) {
            return;
        }
        $category->vendor_id = Filament::getTenant()->id;
    }
}