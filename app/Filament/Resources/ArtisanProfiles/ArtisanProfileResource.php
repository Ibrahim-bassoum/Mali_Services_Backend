<?php

namespace App\Filament\Resources\ArtisanProfiles;

use App\Filament\Resources\ArtisanProfiles\Pages\CreateArtisanProfile;
use App\Filament\Resources\ArtisanProfiles\Pages\EditArtisanProfile;
use App\Filament\Resources\ArtisanProfiles\Pages\ListArtisanProfiles;
use App\Filament\Resources\ArtisanProfiles\Schemas\ArtisanProfileForm;
use App\Filament\Resources\ArtisanProfiles\Tables\ArtisanProfilesTable;
use App\Models\ArtisanProfile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ArtisanProfileResource extends Resource
{
    protected static ?string $model = ArtisanProfile::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ArtisanProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ArtisanProfilesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListArtisanProfiles::route('/'),
            'create' => CreateArtisanProfile::route('/create'),
            'edit' => EditArtisanProfile::route('/{record}/edit'),
        ];
    }
}
