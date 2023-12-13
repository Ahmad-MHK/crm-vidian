<?php

namespace App\Filament\Resources\Test01Resource\Pages;

use App\Filament\Resources\Test01Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTest01s extends ListRecords
{
    protected static string $resource = Test01Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

}
