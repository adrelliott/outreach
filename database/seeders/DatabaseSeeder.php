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
        User::factory()
        ->count(10)
        ->sequence(fn ($sequence) => [
            'email' => 'al' . $sequence->index . '@admin.com' // easy to log in!
        ])
        ->has(Contact::factory()
            ->count(rand(50,150))
        )
        ->create();

    }
}
