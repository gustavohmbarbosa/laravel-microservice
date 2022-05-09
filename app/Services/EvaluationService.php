<?php

namespace App\Services;

use Gustavohmbarbosa\MicroservicesCommon\Services\Traits\ConsumeExternalService;

class EvaluationService
{
    use ConsumeExternalService;

    public function __construct()
    {
        $this->key = config('services.evaluations.key');
        $this->url = config('services.evaluations.url');
    }

    /**
     * @param string $companyId
     * 
     * @return array|null
     */
    public function getCompanyEvaluations(string $companyId): ?array
    {
        $response = $this->request('get', "/{$companyId}/evaluations");

        if ($response->status() !== 200) {
            return null;
        }

        return $response->object()->data;
    }
}
