<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('groups')->truncate();

        app(\App\Repositories\GroupRepository::class)->create([
            'name' => "Admin"
        ]);

        app(\App\Repositories\GroupRepository::class)->create([
            'name' => "Manager"
        ]);

        app(\App\Repositories\GroupRepository::class)->create([
            'name' => "Developer"
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
