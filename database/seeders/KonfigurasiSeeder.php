<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KonfigurasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('konfigurasis')->insert([
            'nama_dashboard'=> 'Blog Vue',
            'nama_dashboard_singkatan'=> 'BVU',
            'nama_portal'=> 'Blog Vue',
            'metatext'=> 'Blog Vue',
            'deskripsi'=> 'Bisa disingkat dengan BLT, kami adalah perusahaan IT yang inovatif dengan kinerja terbaik dalam menciptakan perangkat  lunak yang berkesinanambungan.',
            'logo'=> 'logo.jpeg',
            'email'=> 'testing@gmail.com',
            'icon'=> 'icon.jpeg',
            'auth_image'=> '1619131917_output-onlinepngtools.png.png',
            'fb'=> 'https://www.facebook.com/odis.pyk',
            'ig'=> 'https://www.instagram.com/odis.pyk/',
            'website'=> '#',
            'alamat'=> 'Koto Nan Ampek',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
