<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources\AdvertisementResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\AdvertisementResource;

class ListAdvertisement extends ListRecords
{
    protected static string $resource = AdvertisementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
