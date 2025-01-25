<?php

namespace App\Filament\Resources\JobApplicationResource\Pages;

use App\Filament\Resources\JobApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJobApplication extends EditRecord
{
    protected static string $resource = JobApplicationResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Mark the record as seen
        if (!$this->record->is_seen) {
            $this->record->update(['is_seen' => true]);
        }

        return $data;
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
