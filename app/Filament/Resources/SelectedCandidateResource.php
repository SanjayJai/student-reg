<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SelectedCandidateResource\Pages;
use App\Models\SelectedCandidate;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Support\Facades\Storage;

class SelectedCandidateResource extends Resource
{
    protected static ?string $model = SelectedCandidate::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'HR Management';

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('registration_number')->sortable()->searchable(),
                TextColumn::make('full_name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('phone')->sortable(),
                TextColumn::make('position')->sortable(),

                // ✅ Show Interview Details
                TextColumn::make('technical_date_time')->label('Technical Interview Date')->sortable(),
                TextColumn::make('technical_interviewer')->label('Interviewer')->sortable(),
                TextColumn::make('technical_status')->label('Status')->sortable(),
                TextColumn::make('technical_marks')->label('Marks')->sortable(),

                // ✅ Resume Download with Storage Path Fix
                TextColumn::make('resume')
                    ->label('Resume')
                    ->formatStateUsing(fn ($state) => $state 
                        ? "<a href='" . Storage::url($state) . "' target='_blank'>Download</a>" 
                        : 'No File')
                    ->html(),
            ])
            ->actions([
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkAction::make('delete_selected')
                    ->label('Delete Selected')
                    ->action(fn ($records) => $records->each->delete())
                    ->requiresConfirmation()
                    ->deselectRecordsAfterCompletion(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSelectedCandidates::route('/'),
        ];
    }
}
