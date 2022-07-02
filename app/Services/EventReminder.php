<?php

namespace App\Services;

use App\Mail\NoEvents;
use App\Models\Company;
use Illuminate\Support\Facades\Mail;

class EventReminder
{
    private ?int $companyId;

    public function __construct(?int $companyId = null)
    {
        $this->companyId = $companyId;
    }

    public function handle()
    {
        $companies = $this->companyId
            ? Company::where('id', $this->companyId)->get()
            : Company::all();
        /** @var Company $company */
        foreach ($companies as $company) {
            $company->sendEventReminder();
        }
    }
}
