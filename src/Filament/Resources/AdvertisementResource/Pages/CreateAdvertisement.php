<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources\AdvertisementResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\AdvertisementResource;

class CreateAdvertisement extends CreateRecord
{
    protected static string $resource = AdvertisementResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
