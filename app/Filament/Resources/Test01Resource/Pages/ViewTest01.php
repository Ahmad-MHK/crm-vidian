<?php

namespace App\Filament\Resources\Test01Resource\Pages;

use App\Filament\Resources\Test01Resource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTest01 extends ViewRecord
{
    protected static string $resource = Test01Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
