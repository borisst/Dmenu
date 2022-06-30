<?php

namespace App\Console\Commands;

use App\Mail\UserRegistered;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendGreetingMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send.greeting {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email on registration';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(UserRegistered $userRegistered)
    {
        $email = $this->argument('email');

        Mail::to($email)->send(new UserRegistered());

        return $this->info('Mail sent!');
    }
}
