<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorResource;

class EditVendor extends EditRecord
{
    protected static string $resource = VendorResource::class;


    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (static::hasMacro('mutateVendorDataBeforeEditFormFieldFill')) {
            return $this->mutateVendorDataBeforeEditFormFieldFill($data);
        }
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (static::hasMacro('updateRegistrationData')) {
            # code...
            return static::updateRegistrationData($data);
        }

        return $data;
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
