<?php
namespace App\Filament\Resources\QualityBrandResource\Pages;
use App\Filament\Resources\QualityBrandResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
class EditQualityBrand extends EditRecord { protected static string $resource = QualityBrandResource::class; protected function getHeaderActions(): array { return [Actions\DeleteAction::make()]; } }
