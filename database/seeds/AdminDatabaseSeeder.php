<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Admin::create([
          'name'=>'Admin',
          'email'=>'admin@gmail.com',
          'password'=>bcrypt('123456')
       ]);
    }
}
