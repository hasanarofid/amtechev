<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Actions\EditAction;
use Illuminate\Support\Str;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    public static function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required()->live(onBlur: true)->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
            Forms\Components\TextInput::make('slug')->required()->unique(BlogPost::class, 'slug', ignoreRecord: true),
            Forms\Components\RichEditor::make('content')->required()->columnSpanFull(),
            Forms\Components\FileUpload::make('image_url')->image()->disk('public'),
            Forms\Components\DateTimePicker::make('published_at'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\TextColumn::make('published_at')->dateTime()->sortable(),
        ])->actions([EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit' => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
