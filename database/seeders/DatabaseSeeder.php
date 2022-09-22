<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Industry;
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
        User::factory(10)
        ->has(
            Company::factory()
                ->count(rand(50,100))
                ->has(
                    Contact::factory()
                        ->count(rand(3,7))
                )
            )
            ->create();

        // Company::factory(5)
        //     ->has(Contact::factory()->count(rand(5,10)))
        //     ->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
