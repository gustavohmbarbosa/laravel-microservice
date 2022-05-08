<?php

namespace Tests\Feature\Controllers;

use App\Models\Category;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    const ENDPOINT = 'categories';

    /** @test*/
    public function return_all_categories()
    {
        Category::factory()->count(7)->create();
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
}
