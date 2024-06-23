<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\AdvertisementResource\Pages;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVAdvertisements;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVShopCategory;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVVendor;

class AdvertisementResource extends Resource
{
    protected static ?string $model = SCMVAdvertisements::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function getModelLabel(): string
    {
        return __('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.advertisement.model_label');
        // return __('filament-user-activity::user-activity.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.advertisement.model_plural_label');
        // return __('filament-user-activity::user-activity.resource.model_plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.advertisement.navigation_group');
        // return __('filament-user-activity::user-activity.resource.navigation');
    }

    public static function getNavigationLabel(): string
    {
        return __('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.advertisement.navigation');
        // return __('filament-user-activity::user-activity.resource.navigation');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.advertisement.creation_form.name')),
                TextInput::make('url')
                    ->required()
                    ->label(__('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.advertisement.creation_form.url')),
                SpatieMediaLibraryFileUpload::make('advertisement')
                    ->label(__('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.advertisement.creative'))
                    ->collection('vendor_logos')
                    ->rules('required'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([])->actions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdvertisement::route('/'),
            'create' => Pages\CreateAdvertisement::route('/create'),
            'edit' => Pages\EditAdvertisement::route('/{record}/edit'),
        ];
    }
}
