<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Pages\Tenancy;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVVendor;

class RegisterVendor extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register Vendor';
    }

    public function form(Form $form): Form
    {
        if (static::hasMacro('configureVendorRegistrationForm')) {
            return $this->configureVendorRegistrationForm($form);
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

    protected function handleRegistration(array $data): SCMVVendor
    {
        if (static::hasMacro('saveRegistrationData')) {
            return $this->saveRegistrationData($data);
        }
        $vendor = SCMVVendor::create($data);
        $vendor->members()->attach(auth()->user());
        return $vendor;
    }
}
