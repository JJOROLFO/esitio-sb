<?php

namespace App\Filament\Widgets\Dashboard;


use App\Models\AuthorSponsor;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;

class AuthorCount extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Author & Sponsor Count', AuthorSponsor::count())
                ->icon('heroicon-o-identification')
                ->description('The total count of Author and Sponsor in the system')
                ->descriptionColor('primary')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
        ];
    }
}
