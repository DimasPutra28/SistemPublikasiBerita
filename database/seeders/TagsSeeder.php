<?php

namespace Database\Seeders;

use App\Models\Tags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tags::create(['name' => 'PHP']);
        Tags::create(['name' => 'Laravel']);
        Tags::create(['name' => 'JavaScript']);
        Tags::create(['name' => 'Python']);
        Tags::create(['name' => 'Java']);
        Tags::create(['name' => 'C#']);
        Tags::create(['name' => 'Kesehatan']);
        Tags::create(['name' => 'Olahraga']);
        Tags::create(['name' => 'Makanan']);
        Tags::create(['name' => 'Wisata']);
        Tags::create(['name' => 'Pendidikan']);
        Tags::create(['name' => 'Ekonomi']);
        Tags::create(['name' => 'Politik']);
        Tags::create(['name' => 'Hiburan']);
        Tags::create(['name' => 'Otomotif']);
        Tags::create(['name' => 'Teknologi']);
        Tags::create(['name' => 'Seni']);
        Tags::create(['name' => 'Budaya']);
        Tags::create(['name' => 'Lingkungan']);
        Tags::create(['name' => 'Sosial']);
        Tags::create(['name' => 'Bisnis']);
        Tags::create(['name' => 'Kecantikan']);
        Tags::create(['name' => 'Fashion']);
        Tags::create(['name' => 'Kuliner']);
        Tags::create(['name' => 'Properti']);
        Tags::create(['name' => 'Gadget']);
        Tags::create(['name' => 'Pariwisata']);
        Tags::create(['name' => 'Keluarga']);
        Tags::create(['name' => 'Agama']);
        Tags::create(['name' => 'Sejarah']);
        Tags::create(['name' => 'Musik']);
        Tags::create(['name' => 'Film']);
        Tags::create(['name' => 'Buku']);
        Tags::create(['name' => 'Investasi']);
        Tags::create(['name' => 'Pertanian']);
        Tags::create(['name' => 'Peternakan']);
    }
}
