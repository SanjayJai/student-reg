<?php

namespace App\Filament\Resources\SelectedCandidateResource\Pages;

use App\Filament\Resources\SelectedCandidateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSelectedCandidates extends ListRecords
{
    protected static string $resource = SelectedCandidateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
