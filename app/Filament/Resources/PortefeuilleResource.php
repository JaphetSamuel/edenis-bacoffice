<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortefeuilleResource\Pages;
use App\Filament\Resources\PortefeuilleResource\RelationManagers;
use App\Models\Portefeuille;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PortefeuilleResource extends Resource
{
    protected static ?string $model = Portefeuille::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('solde')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('solde_reel')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('titres')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('solde')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('solde_reel')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('titres')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListPortefeuilles::route('/'),
            'create' => Pages\CreatePortefeuille::route('/create'),
            'view' => Pages\ViewPortefeuille::route('/{record}'),
            'edit' => Pages\EditPortefeuille::route('/{record}/edit'),
        ];
    }    
}
