<?php

namespace App\Console\Commands;

use App\Mail\NoEvents;
use App\Models\Company;
use App\Models\User;
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
        if ($this->argument('company')) {
            $company = Company::where('id', $this->argument('company'))->first();
            $owner = User::where('id', $company->owner)->first();

            if ($company->events()->doesntExist()) {
                \Mail::to($owner->email)->send(new NoEvents());
            }
        }
        else {
            $companies = Company::all();
            foreach ($companies as $company) {
                $owner = User::where('id', $company->owner)->first();

                if ($company->events()->doesntExist()) {
                    \Mail::to($owner->email)->send(new NoEvents());
                }
            }
        }
        return 0;
    }
}
