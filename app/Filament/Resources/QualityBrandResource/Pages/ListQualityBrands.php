<?php
namespace App\Filament\Resources\QualityBrandResource\Pages;
use App\Filament\Resources\QualityBrandResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
class ListQualityBrands extends ListRecords { protected static string $resource = QualityBrandResource::class; protected function getHeaderActions(): array { return [Actions\CreateAction::make()]; } }
