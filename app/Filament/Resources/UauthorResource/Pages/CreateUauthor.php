<?php

namespace App\Filament\Resources\UauthorResource\Pages;

use App\Filament\Resources\UauthorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUauthor extends CreateRecord
{
    protected static string $resource = UauthorResource::class;
    protected static ?string $title = 'Add Author or Sponsor';
    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.uauthors.index');
    }
}
