<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i < 10; $i++){
    		$title = $faker->unique()->sentence;
    		DB::table('blogs')->insert([
        	'id_user'=> 1,
        	'title'=> $title,
        	'slug'=> Str::slug($title),
        	'deskripsi'=> $faker->paragraph,
        	'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    	}
    }
}
