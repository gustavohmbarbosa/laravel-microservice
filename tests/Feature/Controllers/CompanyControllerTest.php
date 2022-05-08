<?php

namespace Tests\Feature\Controllers;

use App\Models\Company;
use Tests\TestCase;

class CompanyControllerTest extends TestCase
{
    const ENDPOINT = '/companies';

    protected Company $entity;

    public function __construct()
    {
        parent::__construct();
        $this->entity = new Company();
    }

    /** @test*/
    public function return_all_companies()
    {
        $this->entity->factory()->count(7)->create();
        $response = $this->getJson(self::ENDPOINT);

        $response->assertStatus(200);
        $response->assertJsonCount(7, 'data');
    }

    /** @test*/
    public function should_return_404_if_company_not_found()
    {
        $response = $this->getJson(self::ENDPOINT . '/faker-id');
        $response->assertStatus(404);
    }

    /** @test*/
    public function should_return_a_single_company()
    {
        $company = $this->entity->factory()->create();

        $response = $this->getJson(self::ENDPOINT . "/{$company->id}");
        $response->assertStatus(200);
    }

    /** @test*/
    public function should_validate_the_company_creation()
    {
        $response = $this->postJson(self::ENDPOINT, []);

        $response->assertStatus(422);
    }

    /** @test */
    public function should_create_a_company_with_correct_values()
    {
        $company = $this->entity->factory()->make()->toArray();
        $response = $this->postJson(self::ENDPOINT, $company);

        $response->assertStatus(201);
        $this->assertDatabaseHas('companies', $company);
    }

    /** @test*/
    public function should_validate_the_company_update()
    {
        $company1 = $this->entity->factory()->create();
        $company2 = $this->entity->factory()->create();

        $response = $this->putJson(self::ENDPOINT . "/faker-id", ['name' => 'name updated']);
        $response->assertStatus(404);

        $response = $this->putJson(self::ENDPOINT . "/{$company1->id}", $company2->toArray());
        $response->assertStatus(422);
    }

    /** @test */
    public function should_update_a_company_with_correct_values()
    {
        $company = $this->entity->factory()->create();
        $company->name = 'name updated';

        $response = $this->putJson(self::ENDPOINT . "/{$company->id}", $company->toArray());
        $response->assertStatus(200);
        $this->assertDatabaseHas('companies', ['name' => 'name updated']);
    }

    /** @test*/
    public function should_return_404_if_company_provided_to_delete_not_found()
    {
        $response = $this->deleteJson(self::ENDPOINT . '/faker-id');
        $response->assertStatus(404);
    }

    /** @test*/
    public function should_delete_a_company()
    {
        $company = $this->entity->factory()->create();

        $response = $this->deleteJson(self::ENDPOINT . "/{$company->id}");
        $response->assertStatus(204);
        $this->assertDatabaseCount('companies', 0);
    }
}
