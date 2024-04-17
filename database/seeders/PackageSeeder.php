<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Package;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            ['name' => 'Wedding & Debut Elegant Sapphire Package'],
            ['name' => 'Wedding & Debut Elegant Silver Package'],
            ['name' => 'Wedding & Debut Elegant Ruby Package'],
            ['name' => 'Wedding & Debut Elegant Gold Package'],
            ['name' => 'Wedding & Debut Elegant Tiffany Package'],
            ['name' => 'Dinner / Lunch Buffet (Ordinary)'],
            ['name' => 'Dinner / Lunch Buffet (Special)'],
        ];

        foreach($packages as $package){
            Package::create($package);
        }
    }
}
