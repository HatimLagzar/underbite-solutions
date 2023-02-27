<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            User::EMAIL_COLUMN => 'admin@admin.com'
        ]);

        \App\Models\User::factory(10)->create();
    }
}
