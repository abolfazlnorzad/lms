<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public static $seeders=[];
    public function run()
    {
        // \App\Model\User::factory(10)->create();
//        $this->call(RolePermissionTableSeeder::class);

        foreach (self::$seeders as $seed){
            $this->call($seed);
        }
    }
}
