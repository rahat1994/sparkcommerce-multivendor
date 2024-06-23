<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources\AdvertisementResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\AdvertisementResource;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\PayoutRequestResource;

class EditAdvertisement extends EditRecord
{
    protected static string $resource = AdvertisementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
