<?php

namespace App\Services;

use App\Mail\NoPromotions;
use App\Models\Company;
use Illuminate\Support\Facades\Mail;

class PromotionReminder
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

//        if ($this->companyId) {
//            $company = Company::findOrFail($this->companyId);
//
//            if ($company->promotions()->doesntExist()) {
//                Mail::to($company->owner->email)->send(new NoPromotions());
//            }
//        } else {
//            $companies = Company::all();
//            foreach ($companies as $company) {
//                if ($company->promotions()->doesntExist()) {
//                    Mail::to($company->owner->email)->send(new NoPromotions());
//                }
//            }
//        }

        /** @var Company $company */
        foreach ($companies as $company) {
            $company->sendPromotionReminder();
        }
    }
}
