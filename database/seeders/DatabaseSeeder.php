<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $myCo = User::factory()->create([
            "name" => "Simone Till",
            "email" => "mcginnisCo@yahoo.com"
        ]);
        Employer::factory()->for($myCo)->create();

        User::factory()->create([
            'name' => 'Clau Tester',
            'email' => 'clau.mcginnis@yahoo.com'
        ]);


        User::factory(150)->create();
        $users = User::all()->shuffle();

        for($i = 0; $i < 20; $i++){
            $user = $users->pop();

            Employer::factory()->for($user)->create();
            Profile::factory()->for($user)->create([
                "name" => $user->name,
                "type" => "company"
            ]);
        }

        $employers = Employer::all();
         for($i = 0; $i < 75; $i++){
            Job::factory()->for($employers->random())->create();
        }    

        foreach($users as $user){
            Profile::factory()->for($user)->create([
                "name" => $user->name,
                "type" => "personal"
            ]);

            $jobs = Job::inRandomOrder()->take(rand(0,4))->get();
            foreach($jobs as $job){
                JobApplication::factory()->for($user)->create([
                    'job_id' => $job->id
                ]);
            }
        }    
    }
}
