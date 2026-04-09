<?php

namespace App\Filament\Resources\InstallationPackages\Pages;

use App\Filament\Resources\InstallationPackageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInstallationPackages extends ListRecords
{
    protected static string $resource = InstallationPackageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
