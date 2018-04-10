<?php

use Illuminate\Database\Seeder;
use App\ValidatedEmail;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        ValidatedEmail::truncate();
        
        factory(ValidatedEmail::class, 50)->create();
    }
}
