<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QualityBrandResource\Pages;
use App\Models\QualityBrand;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class QualityBrandResource extends Resource
{
    protected static ?string $model = QualityBrand::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-shield-check';

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            Forms\Components\Textarea::make('description'),
            Forms\Components\FileUpload::make('logo')->image()->disk('public'),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->searchable(),
            Tables\Columns\ImageColumn::make('logo'),
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
            'index' => Pages\ListQualityBrands::route('/'),
            'create' => Pages\CreateQualityBrand::route('/create'),
            'edit' => Pages\EditQualityBrand::route('/{record}/edit'),
        ];
    }
}
