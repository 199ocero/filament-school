<?php

namespace App\Filament\Resources\StudentResource\Pages;

use Filament\Pages\Actions;
use App\Services\ImportService;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\StudentResource;
use Filament\Resources\Pages\ManageRecords;

class ManageStudents extends ManageRecords
{
    protected static string $resource = StudentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('Import Student')
                ->action(fn ($data) => (new ImportService())->import($data['csv']))
                ->form([
                    FileUpload::make('csv')
                        ->acceptedFileTypes(['text/csv', 'application/csv'])
                        ->directory('upload-attachments')
                ])

        ];
    }
}
