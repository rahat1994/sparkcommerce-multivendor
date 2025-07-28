<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources\PayoutRequestResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\PayoutRequestResource;

class CreatePayoutRequest extends CreateRecord
{
    protected static string $resource = PayoutRequestResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $meta = [
            'bank_account_name' => $data['bank_account_name'],
            'bank_account_number' => $data['bank_account_number'],
            'bank_sort_code' => $data['bank_sort_code'],
            'bank_name' => $data['bank_name'],
        ];
        unset($data['bank_account_name'], $data['bank_account_number'], $data['bank_sort_code'], $data['bank_name']);

        $data['bank_info'] = $meta;
        return $data;
    }
}
