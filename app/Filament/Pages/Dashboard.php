<?php

namespace App\Filament\Pages;

use App\Models\JobApplication;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    public JobApplication $jobApplication;

    public function mount()
    {
        $this->jobApplication = new jobApplication;
    }
}
