<?php

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        User::truncate();
        factory(User::class)->create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
        ]);
    }
}
