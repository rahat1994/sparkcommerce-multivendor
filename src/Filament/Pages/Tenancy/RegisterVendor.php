<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Pages\Tenancy;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVVendor;

class RegisterVendor extends RegisterTenant
{
    // public static $title = 'Register Vendor';

    // public static $slug = 'register-vendor';

    public static function getLabel(): string
    {
        return 'Register Vendor';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->placeholder('John Doe'),
                TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->placeholder('johndoe@example.com'),
            ]);
    }

    protected function handleRegistration(array $data): SCMVVendor
    {
        $vendor = SCMVVendor::create($data);

        $vendor->members()->attach(auth()->user());

        return $vendor;
    }
}
