<?php

namespace App\Filament\Resources\ResolutionResource\Pages;

use App\Filament\Resources\ResolutionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateResolution extends CreateRecord
{
    protected static string $resource = ResolutionResource::class;
    protected static ?string $title = 'Add Resolution';

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.resolutions.index');
    }
}
