<?php

namespace App\Filament\Resources\RegistrarResource\Pages;

use App\Filament\Resources\RegistrarResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRegistrar extends EditRecord
{
    protected static string $resource = RegistrarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
