<?php

namespace App\Observers;

use App\Models\Company;
use Illuminate\Support\Str;
use App\Jobs\CompanyCreatedJob;

class CompanyObserver
{
    /**
     * Handle the Company "creating" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function creating(Company $company)
    {
        $company->id = Str::uuid();
        $company->url = Str::slug($company->name, '-');
    }

    /**
     * Handle the Company "created" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function created(Company $company)
    {
        CompanyCreatedJob::dispatch($company->email);
    }

    /**
     * Handle the Company "updating" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function updating(Company $company)
    {
        $company->url = Str::slug($company->name, '-');
    }
}
