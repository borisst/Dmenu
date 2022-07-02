<?php

namespace App\Console\Commands;

use App\Mail\NoEvents;
use App\Models\Company;
use App\Models\User;
use App\Services\EventReminder;
use Illuminate\Console\Command;

class CheckForEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:events {company?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if Company has an event';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(NoEvents $noEvents)
    {
        (new EventReminder($this->argument('company')))->handle();

        return $this->info('Mails sent');
    }
}
