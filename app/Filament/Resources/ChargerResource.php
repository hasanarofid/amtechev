<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChargerResource\Pages;
use App\Models\Charger;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class ChargerResource extends Resource
{
    protected static ?string $model = Charger::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-bolt';

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\TextInput::make('price'),
            Forms\Components\FileUpload::make('image_url')->image()->disk('public'),
            Forms\Components\Textarea::make('description'),
            Forms\Components\Toggle::make('is_featured')->default(true),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\ImageColumn::make('image_url'),
            Tables\Columns\TextColumn::make('price'),
            Tables\Columns\IconColumn::make('is_featured')->boolean(),
        ])->actions([EditAction::make()])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListChargers::route('/'),
            'create' => Pages\CreateCharger::route('/create'),
            'edit' => Pages\EditCharger::route('/{record}/edit'),
        ];
    }
}
