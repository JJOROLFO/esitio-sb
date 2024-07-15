<?php

namespace App\Filament\Resources\UauthorResource\Pages;

use App\Filament\Resources\UauthorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUauthors extends ListRecords
{
    protected static string $resource = UauthorResource::class;
    protected static ?string $title = 'Authors & Sponsors';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add Author or Sponsor')
                // ->modalHeading('Add Ordinance')
                ->createAnother(false),
        ];
    }
}
