<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /// add admin user
        $firstName = 'Admin';
        $lastName = 'Bo';
        $image = generateAvatarByName($firstName, $lastName);
        DB::table('users')->insert([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'image' => $image,
            'role' => \App\User::ADMIN,
            'email' => 'admin@chatbot.com',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'password' => Hash::make('123456'),
        ]);
        /// seed Db
        factory(App\User::class, 35)->create();
        factory(App\Group::class, 10)->create();
        factory(App\Question::class, 50)->create();
        factory(App\History::class, 350)->create();

    }
}
