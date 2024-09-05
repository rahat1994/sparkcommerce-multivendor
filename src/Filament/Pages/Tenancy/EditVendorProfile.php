<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Pages\Tenancy;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\EditTenantProfile;
use Illuminate\Database\Eloquent\Model;

class EditVendorProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Vendor profile';
    }

    public function form(Form $form): Form
    {
        if (static::hasMacro('configureVendorProfileEditForm')) {
            return $this->configureVendorProfileEditForm($form);
        }

        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->placeholder('Store Name'),
                Select::make('category')
                    ->label('Category')
                    ->required()
                    ->options([
                        'Pultry' => 'Poultry',
                        'Drinks' => 'Drinks',
                        'Fish' => 'Fish',
                    ]),
                TextInput::make('contanct_number')
                    ->label('Contact Number')
                    ->required()
                    ->placeholder('Phone Number'),
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->placeholder('johndoe@example.com'),
            ]);
    }

    public function handleRecordUpdate(Model $record, array $data): Model
    {
        if (static::hasMacro('saveProfileUpdatedData')) {
            return $this->saveProfileUpdatedData($record, $data);
        }
        return $record;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (static::hasMacro('mutateVendorProfileDataBeforeEditFormFieldFill')) {
            return $this->mutateVendorProfileDataBeforeEditFormFieldFill($data);
        }
        return $data;
    }
}
