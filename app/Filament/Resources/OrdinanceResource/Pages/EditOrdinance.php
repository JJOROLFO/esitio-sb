<?php

namespace App\Filament\Resources\OrdinanceResource\Pages;

use App\Filament\Resources\OrdinanceResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditOrdinance extends EditRecord
{
    protected static string $resource = OrdinanceResource::class;
    protected static ?string $title = 'Edit Ordinance';

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\DeleteAction::make(),
    //     ];
    // }
    protected function getRedirectUrl(): string
    {
        return route('filament.admin.resources.ordinances.index');
    }
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User updated')
            ->body('The user has been saved successfully.');
    }
}
