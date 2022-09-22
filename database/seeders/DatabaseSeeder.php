<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Industry;
use App\Models\Pipeline;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        // Create users
        $users = User::factory()
        ->count(10)
        ->sequence(fn ($sequence) => [
            'email' => 'al' . $sequence->index . '@admin.com' // easy to log in!
        ])
        ->create();

        // Add some seed data to each user, and each contact 
        foreach ($users as $user) {
            // create ideas/templates


            $pipelines = Pipeline::factory()
                ->count(rand(2,5))
                ->create([
                    'user_id' => $user->id
                ]);
            
            $contacts = Contact::factory()
                ->count(rand(50,100))
                ->state(new Sequence(function ($sequence) use ($pipelines) {
                    return ['pipeline_id' => $pipelines->random()->id];
                    })
                )
                ->has(Company::factory())
                ->create([
                    'user_id' => $user->id
                ]);
            
                // Create blocks
            
                // add emails etc to contacts
        }

    }
}
