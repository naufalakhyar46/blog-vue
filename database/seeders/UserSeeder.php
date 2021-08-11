<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $cek = DB::table('users')->where('email','admin@blog.com')->first();
        if(!$cek){
            DB::table('users')->insert([
                'name'=>'Admin',
                'email'=>'admin@blog.com',
                'password'=>Hash::make('admin123'),
            ]);
        }
        for($i=1; $i <= 5; $i++){
            DB::table('users')->insert([
                'name'=>$faker->name,
                'email'=>$faker->email,
                'password'=>Hash::make('admin123'),
            ]);
        }
    }
}
