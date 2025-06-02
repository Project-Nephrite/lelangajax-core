<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use App\Models\Listing;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Creation of user
     */
    public function test_user_creation(): void
    {
        $user = User::factory()->create();

        $this->assertModelExists($user);
    }


    public function test_user_has_listings(): void
    {
        $user = User::factory()->create();
        $user = User::query()->first();
        $this->seed([CategorySeeder::class]);
        $category = Category::query()->find(1);

        $assertListing = Listing::factory()->create([
            "category_id" => $category->id,
            "user_id" => $user->id
        ]);
        $this->assertEquals($user->listings()->first()->id, $assertListing->id);
    }
}
