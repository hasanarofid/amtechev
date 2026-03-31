<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryItemResource\Pages;
use App\Models\GalleryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class GalleryItemResource extends Resource
{
    protected static ?string $model = GalleryItem::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-photo';

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\TextInput::make('title'),
            Forms\Components\TextInput::make('image_path')->required(),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\TextColumn::make('image_path'),
            Tables\Columns\TextColumn::make('sort_order')->numeric()->sortable(),
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
            'index' => Pages\ListGalleryItems::route('/'),
            'create' => Pages\CreateGalleryItem::route('/create'),
            'edit' => Pages\EditGalleryItem::route('/{record}/edit'),
        ];
    }
}
