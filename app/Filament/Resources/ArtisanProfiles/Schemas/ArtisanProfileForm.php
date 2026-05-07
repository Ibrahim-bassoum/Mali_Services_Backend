<?php

namespace App\Filament\Resources\ArtisanProfiles\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ArtisanProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('category_id')
                    ->required()
                    ->numeric(),
                Textarea::make('bio')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('experience_years')
                    ->required()
                    ->default('0'),
                TextInput::make('skills')
                    ->default(null),
                Toggle::make('is_available')
                    ->required(),
                TextInput::make('base_location')
                    ->default(null),
                Toggle::make('is_verified')
                    ->required(),
                TextInput::make('rating_average')
                    ->required()
                    ->numeric()
                    ->default(0.0),
            ]);
    }
}
