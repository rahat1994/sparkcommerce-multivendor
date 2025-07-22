<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorResource;
use Illuminate\Database\Eloquent\Model;

class CreateVendor extends CreateRecord
{
    protected static string $resource = VendorResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        if (static::hasMacro('saveRegistrationData')) {
            return static::saveRegistrationData($data);
        }
        return static::getModel()::create($data);
    }
}
