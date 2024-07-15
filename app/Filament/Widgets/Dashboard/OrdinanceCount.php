<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\Ordinance;
use App\Models\Resolution;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;

class OrdinanceCount extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Ordinance Count', Ordinance::count())
                ->icon('heroicon-o-clipboard-document-list')
                ->description('The total count of ordinances in the system')
                ->descriptionColor('primary')
                ->descriptionIcon('heroicon-o-arrow-trending-up'),
                Card::make('Resolution Count', Resolution::count())
                ->icon('heroicon-o-clipboard-document-list')
                ->description('The total count of resolution in the system')
                ->descriptionColor('primary')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
        ];
    }
}
