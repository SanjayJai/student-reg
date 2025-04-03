<?php

namespace App\Filament\Resources\SelectedCandidateResource\Pages;

use App\Filament\Resources\SelectedCandidateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSelectedCandidate extends EditRecord
{
    protected static string $resource = SelectedCandidateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
