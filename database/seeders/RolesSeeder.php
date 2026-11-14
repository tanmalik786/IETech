<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
			'Teaching Student',
	        'Mentor',
	        'Link Tutor',
	        'Super Admin',
	        'Institute Admin',
	        'Subscriber'
        ];

		foreach($roles as $role) {

			if( Role::where('name', $role)->count() == 0 ) {
				Role::create([
					'name' => $role
				]);
			}
		}
    }
}
