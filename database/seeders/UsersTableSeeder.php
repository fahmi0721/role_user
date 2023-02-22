<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            "username"      => "fahmi07 ",
            "password"      => bcrypt("fahmi07"),
            "nama_user"    => "Fahmi Idrus",
            "status"         => "1",
        ]);
    }
}
