<?php

namespace Tests\Feature\Controllers;

use App\Models\Category;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    /** @test*/
    public function return_all_categories()
    {
        Category::factory()->count(7)->create();
        $response = $this->getJson('/categories');

        $response->assertStatus(200);
        $response->assertJsonCount(7, 'data');
    }
}
