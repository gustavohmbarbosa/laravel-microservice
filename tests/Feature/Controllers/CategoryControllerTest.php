<?php

namespace Tests\Feature\Controllers;

use App\Models\Category;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    const ENDPOINT = 'categories';

    protected Category $entity;

    public function __construct()
    {
        parent::__construct();
        $this->entity = new Category();
    }

    /** @test*/
    public function return_all_categories()
    {
        $this->entity->factory()->count(7)->create();
        $response = $this->getJson(self::ENDPOINT);

        $response->assertStatus(200);
        $response->assertJsonCount(7, 'data');
    }

    /** @test*/
    public function should_return_404_if_category_not_found()
    {
        $response = $this->getJson(self::ENDPOINT . '/faker-url');
        $response->assertStatus(404);
    }

    /** @test*/
    public function should_return_a_single_category()
    {
        $category = $this->entity->factory()->create();

        $response = $this->getJson(self::ENDPOINT . "/{$category->url}");
        $response->assertStatus(200);
    }
}
