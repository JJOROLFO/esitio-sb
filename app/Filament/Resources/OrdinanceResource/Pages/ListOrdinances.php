<?php

namespace App\Filament\Resources\OrdinanceResource\Pages;

use App\Filament\Resources\OrdinanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListOrdinances extends ListRecords
{
    protected static string $resource = OrdinanceResource::class;
    protected static ?string $title = 'Ordinances';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add Ordinance')
                // ->modalHeading('Add Ordinance')
                ->createAnother(false),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->orderByDesc('id');
    }
    
}
