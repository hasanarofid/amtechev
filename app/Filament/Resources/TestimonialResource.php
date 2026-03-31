<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\Textarea::make('content')->required()->columnSpanFull(),
            Forms\Components\TextInput::make('author_name')->required(),
            Forms\Components\TextInput::make('author_role'),
            Forms\Components\FileUpload::make('author_image')->image()->disk('public'),
            Forms\Components\TextInput::make('rating')->numeric()->default(5),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('author_name')->searchable(),
            Tables\Columns\TextColumn::make('author_role')->searchable(),
            Tables\Columns\TextColumn::make('rating')->numeric(),
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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
