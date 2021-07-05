<?php

namespace Nrz\Category\Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    use RefreshDatabase, WithFaker;

//    public function createUserAsAdminAndLogin()
//    {
//        return $user = User::create([
//            'name' => $this->faker->name,
//            'email' => $this->faker->safeEmail,
//            'phone' => '9011216133',
//            'password' => bcrypt('@b01faZ1')
//        ]);
//
//    }

//    public function createNewCategory()
//    {
//        return Category::create([
//            'title' => $this->faker->word,
//            'slug' => $this->faker->word
//        ]);
//    }
//
//    public function testUserCanIndexPage()
//    {
//        $this->withExceptionHandling();
//        $this->actingAs(User::factory()->create());
//        $this->assertAuthenticated();
//    }
//
////    public function testUserStoreNewCategory()
////    {
////        $this->createUserAsAdminAndLogin();
////        $this->assertAuthenticated();
////        $this->createNewCategory();
////        $this->assertEquals(1, Category::all()->count());
////
////    }


}
