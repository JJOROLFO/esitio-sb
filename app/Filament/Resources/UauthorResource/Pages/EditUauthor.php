<?php

namespace App\Filament\Resources\UauthorResource\Pages;

use App\Filament\Resources\UauthorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUauthor extends EditRecord
{
    protected static string $resource = UauthorResource::class;
    protected static ?string $title = 'Edit Author or Sponsor';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.uauthors.index');
    }
}
