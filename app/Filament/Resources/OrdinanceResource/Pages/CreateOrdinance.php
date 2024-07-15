<?php

namespace App\Filament\Resources\OrdinanceResource\Pages;

use App\Filament\Resources\OrdinanceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrdinance extends CreateRecord
{
    protected static string $resource = OrdinanceResource::class;
    protected static ?string $title = 'Add Ordinance';
    
    

    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.ordinances.index');
    }
}
