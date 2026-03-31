<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\TextInput::make('key')->required()
                ->disabled(fn (?SiteSetting $record) => $record !== null)
                ->unique(ignoreRecord: true),
            Forms\Components\Textarea::make('value')->required(),
            Forms\Components\TextInput::make('group')->default('general'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('key')->searchable(),
            Tables\Columns\TextColumn::make('value')->limit(50),
            Tables\Columns\TextColumn::make('group')->badge(),
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
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
