<?php

namespace App\Filament\Resources\Test01Resource\Pages;

use App\Filament\Resources\Test01Resource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTest01 extends CreateRecord
{
    protected static string $resource = Test01Resource::class;

    protected function getRedirectUrl(): string
    {
            return $this->getResource()::getUrl('index');
    }
}
