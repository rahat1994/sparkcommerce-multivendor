<?php

namespace Rahat1994\SparkcommerceMultivendor\Filament\Resources\VendorResource\RelationManagers;

use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MembersRelationManager extends RelationManager
{

    protected static string $relationship = 'members';

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name'),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('email')
            ->actions([
                DetachAction::make(),
                ViewAction::make(),
            ])
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
            ])
            ->filters([
                //
            ])->headerActions([
                CreateAction::make('create_new_card'),
                AttachAction::make()
                    ->after(function (array $data) {
                        $vendorOwnerRoleLabel = config('sparkcommerce-multivendor.vendor_owner_role');
                        $id = $data['recordId'][0];
                        //  get user with by id
                        $user = User::find($id);
                        $user->assignRole($vendorOwnerRoleLabel);
                    })
                    ->multiple()
            ]);
    }
}
