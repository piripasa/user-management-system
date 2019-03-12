<?php

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
        Schema::disableForeignKeyConstraints();

        DB::table('users')->truncate();

        $user = app(\App\Repositories\UserRepository::class)->create([
            'name' => "Zaman",
            'email' => "zaman@test.test",
            'password' => '123456'
        ]);

        $admin = app(\App\Repositories\GroupRepository::class)->findBy('slug', 'admin');

        $user->groups()->attach($admin);

        Schema::enableForeignKeyConstraints();
    }
}
