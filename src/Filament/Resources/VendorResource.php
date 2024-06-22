<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorResource\Pages;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVShopCategory;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVVendor;

class VendorResource extends Resource
{
    protected static ?string $model = SCMVVendor::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function getModelLabel(): string
    {
        return __('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.vendor.model_label');
        // return __('filament-user-activity::user-activity.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.vendor.model_plural_label');
        // return __('filament-user-activity::user-activity.resource.model_plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.vendor.navigation_group');
        // return __('filament-user-activity::user-activity.resource.navigation');
    }

    public static function getNavigationLabel(): string
    {
        return __('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.vendor.navigation');
        // return __('filament-user-activity::user-activity.resource.navigation');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.vendor.name')),
                TextInput::make('email')
                    ->email()
                    ->label(__('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.vendor.email')),
                TextInput::make('contact_number')
                    ->label(__('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.vendor.phone')),
                Select::make('category')
                    ->multiple()
                    ->label(__('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.vendor.category'))
                    ->options(SCMVShopCategory::all()->pluck('name')->toArray()),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('contact_number'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Make Top Vendor')
                    ->label(__('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.vendor.make_top_vendor'))
                    ->visible(function (SCMVVendor $record) {
                        if ($record->meta === null) {
                            return true;
                        } else if ($record->meta !== null && !isset($record->meta['is_top_vendor']) || $record->meta['is_top_vendor'] === 0) {
                            return true;
                        }
                    })
                    ->requiresConfirmation()
                    ->icon('heroicon-c-arrow-up-circle')
                    ->action(function (SCMVVendor $record) {
                        if ($record->meta !== null && isset($record->meta['is_top_vendor']) && $record->meta['is_top_vendor'] === 0) {
                            $record->meta['is_top_vendor'] = 1;
                            $record->save();
                        } else if ($record->meta !== null && !isset($record->meta['is_top_vendor'])) {
                            $record->meta = ['is_top_vendor' => 1];
                            $record->save();
                        } else if ($record->meta === null) {
                            $record->meta = ['is_top_vendor' => 1];
                            $record->save();
                        }

                        Notification::make()
                            ->title('Vendor Updated')
                            ->success()
                            ->send();

                        return;
                    })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListVendor::route('/'),
            'create' => Pages\CreateVendor::route('/create'),
            'edit' => Pages\EditVendor::route('/{record}/edit'),
        ];
    }
}
