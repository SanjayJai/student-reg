<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CandidateResource\Pages;
use App\Models\Candidate;
use App\Models\SelectedCandidate;
use Filament\Forms;
use Filament\Forms\Components\{TextInput, Select, DatePicker, Textarea, FileUpload, Section};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\{TextColumn, BadgeColumn};
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Mail;
use App\Mail\InterviewScheduleMail;

class CandidateResource extends Resource
{
    protected static ?string $model = Candidate::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'HR Management';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Section::make('Personal Details')
                    ->schema([
                        TextInput::make('full_name')->required()->maxLength(255),
                        TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
                        TextInput::make('phone')->required()->maxLength(20),
                        DatePicker::make('dob')->required(),
                        Select::make('gender')
                            ->options(['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'])
                            ->required(),
                        Textarea::make('address')->required(),
                        Select::make('position')
                            ->options([
                                'Web Developer' => 'Web Developer',
                                'Software Engineer' => 'Software Engineer',
                                'Digital Marketing Executive' => 'Digital Marketing Executive',
                                'Cyber Security Analyst' => 'Cyber Security Analyst',
                                'HR Executive' => 'HR Executive',
                                'Graphic Designer' => 'Graphic Designer',
                            ])
                            ->required(),
                        TextInput::make('qualification')->required(),
                        TextInput::make('institution')->required(),
                        TextInput::make('year_passing')->required(),
                        TextInput::make('specialization')->required(),
                        Textarea::make('skills'),
                        TextInput::make('registration_number')->required(),
                        FileUpload::make('resume')
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->downloadable()
                            ->openable()
                            ->previewable(false),
                    ]),

                Section::make('Final Decision')
                    ->schema([
                        Select::make('overall_status')
                            ->options(['Shortlisted' => 'Shortlisted', 'Rejected' => 'Rejected', 'On Hold' => 'On Hold'])
                            ->label('Overall Status')
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('phone')->sortable(),
                TextColumn::make('registration_number')->sortable()->searchable(),
                BadgeColumn::make('position'),
                TextColumn::make('dob')->date()->sortable(),
                TextColumn::make('year_passing')->sortable(),
            ])
            ->filters([
                SelectFilter::make('position')
                    ->options([
                        'Web Developer' => 'Web Developer',
                        'Software Engineer' => 'Software Engineer',
                        'Digital Marketing Executive' => 'Digital Marketing Executive',
                        'Cyber Security Analyst' => 'Cyber Security Analyst',
                        'HR Executive' => 'HR Executive',
                        'Graphic Designer' => 'Graphic Designer',
                    ]),
            ])
            ->actions([
                Action::make('Select Candidate')
                    ->label('Select Candidate')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn (Candidate $record) => static::selectCandidate($record)),
                
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function selectCandidate(Candidate $candidate)
    {
        // ✅ Move Candidate to SelectedCandidate table with Interview Details
        $selected = SelectedCandidate::updateOrCreate(
            ['registration_number' => $candidate->registration_number],
            [
                'full_name' => $candidate->full_name,
                'email' => $candidate->email,
                'phone' => $candidate->phone,
                'position' => $candidate->position,
                'resume' => $candidate->resume,
                'technical_date_time' => now()->addDays(3), // Default interview date (3 days later)
                'technical_interviewer' => 'HR Team', // Default interviewer
                'technical_status' => 'Scheduled',
                'technical_marks' => null,
            ]
        );

        // ✅ Send Interview Schedule via Email
        Mail::to($candidate->email)->send(new InterviewScheduleMail($selected));

        // ✅ Delete candidate from Candidate model
        $candidate->delete();

        return redirect()->to('/admin/selected-candidates')
            ->with('success', 'Candidate selected and interview scheduled!');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCandidates::route('/'),
            'create' => Pages\CreateCandidate::route('/create'),
            'edit' => Pages\EditCandidate::route('/{record}/edit'),
        ];
    }
}
