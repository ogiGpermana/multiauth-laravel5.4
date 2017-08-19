<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new Admin();
      $user->name = "Admin";
      $user->email = "hunterdumay@gmail.com";
      $user->password = bcrypt('secret');
      $user->save();
    }
}
