<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Rahat1994\SparkcommerceMultivendor\Filament\Resources\PayoutRequestResource\Pages;
use Rahat1994\SparkcommerceMultivendor\Models\SCMVPayoutRequest;

class PayoutRequestResource extends Resource
{
    protected static ?string $model = SCMVPayoutRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function getModelLabel(): string
    {
        return __('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.payout_request.model_label');
        // return __('filament-user-activity::user-activity.resource.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.payout_request.model_plural_label');
        // return __('filament-user-activity::user-activity.resource.model_plural_label');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.payout_request.navigation_group');
        // return __('filament-user-activity::user-activity.resource.navigation');
    }

    public static function getNavigationLabel(): string
    {
        return __('sparkcommerce-multivendor::sparkcommerce-multivendor.resource.payout_request.navigation');
        // return __('filament-user-activity::user-activity.resource.navigation');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // UK Bank Information Section
                \Filament\Forms\Components\Section::make(__('Payout Details'))
                    ->description(__('Please provide your UK bank details for payout.'))
                    ->schema([
                                        // Amount field
                        \Filament\Forms\Components\TextInput::make('amount')
                            ->required()->numeric()
                            ->label(__('Amount')),
                        \Filament\Forms\Components\TextInput::make('bank_account_name')
                            ->label(__('Account Holder Name'))
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('bank_account_number')
                            ->label(__('Account Number'))
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('bank_sort_code')
                            ->label(__('Sort Code'))
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('bank_name')
                            ->label(__('Bank Name'))
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('amount')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->mutateRecordDataUsing(function (array $data): array {

                    $bankInfo = $data['bank_info'] ?? [];
                    $data['bank_account_name'] = $bankInfo['bank_account_name'] ?? '';
                    $data['bank_account_number'] = $bankInfo['bank_account_number'] ?? '';
                    $data['bank_sort_code'] = $bankInfo['bank_sort_code'] ?? '';
                    $data['bank_name'] = $bankInfo['bank_name'] ?? '';
                    unset($data['bank_info']);

                    return $data;
                }),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPayoutRequest::route('/'),
            'create' => Pages\CreatePayoutRequest::route('/create')
        ];
    }


}
