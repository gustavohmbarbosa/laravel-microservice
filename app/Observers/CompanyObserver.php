<?php

namespace App\Observers;

use App\Models\Company;
use Illuminate\Support\Str;

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
     * Handle the Company "updating" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function updating(Company $company)
    {
        //
    }
}
