<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // super admin
	    $this->createUsers(1, 'Super Admin');
//	    $this->createUsers(10, 'Teaching Student');
//	    $this->createUsers(3, 'Mentor');
//	    $this->createUsers(3, 'Link Tutor');
    }

	public function createUsers( $count = 1, $roleName = 'Teaching Student' ) {
		$faker = Faker::create();

		for ($i = 0; $i < $count; $i++) {
			$user = User::create([
				'first_name' => $faker->firstName,
				'last_name' => $faker->lastName,
				'tagline' => $faker->jobTitle,
				'email' => $faker->unique()->email,
				'password' => bcrypt('secret'),
				'slug' => $faker->slug
			]);

			$user->assignRole($roleName);
		}
	}
}
