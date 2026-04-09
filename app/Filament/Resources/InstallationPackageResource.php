<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstallationPackages\Pages\CreateInstallationPackage;
use App\Filament\Resources\InstallationPackages\Pages\EditInstallationPackage;
use App\Filament\Resources\InstallationPackages\Pages\ListInstallationPackages;
use App\Filament\Resources\InstallationPackages\Schemas\InstallationPackageForm;
use App\Filament\Resources\InstallationPackages\Tables\InstallationPackagesTable;
use App\Models\InstallationPackage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InstallationPackageResource extends Resource
{
    protected static ?string $model = InstallationPackage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return InstallationPackageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InstallationPackagesTable::configure($table);
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
            'index' => ListInstallationPackages::route('/'),
            'create' => CreateInstallationPackage::route('/create'),
            'edit' => EditInstallationPackage::route('/{record}/edit'),
        ];
    }
}
