<?php

namespace App\Filament\Resources\Test01Resource\Pages;

use App\Filament\Resources\Test01Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTest01 extends EditRecord
{
    protected static string $resource = Test01Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
