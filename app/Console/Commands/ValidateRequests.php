<?php

namespace App\Console\Commands;

// app/Console/Commands/ValidateRequests.php

use Illuminate\Console\Command;
use App\Services\RequestService;

class ValidateRequests extends Command
{
    protected $signature = 'requests:validate';
    protected $description = 'Validate request statuses with Contisign';

    public function handle(RequestService $requestService)
    {
        $requestService->validateRequests();

        $this->info('Requests validated successfully.');
    }
}
