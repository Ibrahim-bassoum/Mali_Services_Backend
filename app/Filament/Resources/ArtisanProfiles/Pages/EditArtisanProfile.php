<?php

namespace App\Filament\Resources\ArtisanProfiles\Pages;

use App\Filament\Resources\ArtisanProfiles\ArtisanProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditArtisanProfile extends EditRecord
{
    protected static string $resource = ArtisanProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
