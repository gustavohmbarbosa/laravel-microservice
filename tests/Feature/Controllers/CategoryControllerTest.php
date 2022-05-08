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

    /** @test*/
    public function should_validate_the_category_creation()
    {
        $response = $this->postJson(self::ENDPOINT, [
            'title' => '',
            'description' => ''
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function should_create_a_category_with_correct_values()
    {
        $category = $this->entity->factory()->make()->toArray();
        $response = $this->postJson(self::ENDPOINT, $category);

        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', $category);
    }

    /** @test*/
    public function should_validate_the_category_update()
    {
        $category = $this->entity->factory()->create();
        $category->title = 'updated';

        $response = $this->putJson(self::ENDPOINT . "/faker-url", $category->toArray());
        $response->assertStatus(404);

        $response = $this->putJson(self::ENDPOINT . "/{$category->url}", []);
        $response->assertStatus(422);
    }

    /** @test */
    public function should_update_a_category_with_correct_values()
    {
        $category = $this->entity->factory()->create();
        $category->description = 'updated';

        $response = $this->putJson(self::ENDPOINT . "/{$category->url}", $category->toArray());
        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', ['description' => 'updated']);
    }
}
