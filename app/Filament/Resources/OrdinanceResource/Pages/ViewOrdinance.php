<?php

namespace App\Filament\Resources\OrdinanceResource\Pages;

use App\Filament\Resources\OrdinanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewOrdinance extends ViewRecord
{
    protected static string $resource = OrdinanceResource::class;
}


// <?php

// namespace App\Filament\Resources\OrdinanceResource\Pages;

// use App\Filament\Resources\OrdinanceResource;
// use App\Models\Ordinance;
// use Filament\Actions;
// use Filament\Resources\Pages\Page;
// use PhpParcer\Node\Expr\Cast\object_;

// class ViewOrdinance extends Page
// {
//     protected static string $resource = OrdinanceResource::class;

//     protected static string $view = 'infolists.components.view-file';

//     protected function getData(): ?Object {
//         $id = request()->segment (4);

//         $result = Ordinance::find($id);

//         return $result;
//     }
// }
