<?php

namespace App\Console\Commands;

use App\Mail\NoPromotions;
use App\Models\Company;
use App\Models\User;
use App\Services\PromotionReminder;
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
        (new PromotionReminder($this->argument('company')))->handle();

        return $this->info('Mails sent');
    }
}
