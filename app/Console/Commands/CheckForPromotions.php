<?php

namespace App\Console\Commands;

use App\Mail\NoPromotions;
use App\Models\Company;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckForPromotions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:promotions {company?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if Company has a promotion';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(NoPromotions $noPromotions)
    {
        if ($this->argument('company')) {
//            $company = Company::where('id', $this->argument('company'))->first();
            $company = Company::findOrFail($this->argument('company'));

            if ($company->promotions()->doesntExist()) {
                Mail::to($company->owner->email)->send(new NoPromotions());
            }
        }

        else {
            $companies = Company::all();
            foreach ($companies as $company) {
//                $owner = User::where('id', $company->owner)->first();

                if ($company->promotions()->doesntExist()) {
                    Mail::to($company->owner->email)->send(new NoPromotions());
                }
            }
        }

        return $this->info('Mails sent');
    }
}
