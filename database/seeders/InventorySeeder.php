<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inventory;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $inventoryItems = [
            ['CHAIRS MONOBLOCK', 15.00, 'CHAIRS & TABLES'],
            ['CHAIRS W/ COVER', 25.00, 'CHAIRS & TABLES'],
            ['ROUND TABLE (10 PAX)', 100.00, 'CHAIRS & TABLES'],
            ['ROUND TABLE W/ FLOORLENGTH (10 PAX)', 150.00, 'CHAIRS & TABLES'],
            ['ROUND TABLE (8 PAX)', 100.00, 'CHAIRS & TABLES'],
            ['ROUND TABLE W/ FLOORLENGTH (8 PAX)', 150.00, 'CHAIRS & TABLES'],
            ['LONG TABLE (WOOD)', 80.00, 'CHAIRS & TABLES'],
            ['LONG TABLE W/ COVER', 120.00, 'CHAIRS & TABLES'],
            ['SQUARE TABLE', 50.00, 'CHAIRS & TABLES'],
            ['SQUARE TABLE W/ CLOTH', 80.00, 'CHAIRS & TABLES'],
            ['COCKTAIL TABLE', 150.00, 'CHAIRS & TABLES'],
            ['COCKTAIL TABLE W/ CLOTH', 250.00, 'CHAIRS & TABLES'],
            ['KIDDIE SETS W/ CLOTH', 150.00, 'CHAIRS & TABLES'],
            ['TIFFANY CHAIR', 100.00, 'CHAIRS & TABLES'],
            ['DINNER PLATE', 6.00, 'CATERING EQUIPMENT'],
            ['SERVING TRAY', 20.00, 'CATERING EQUIPMENT'],
            ['PLATITO', 3.00, 'CATERING EQUIPMENT'],
            ['PITCHER', 25.00, 'CATERING EQUIPMENT'],
            ['FORK & SPOON', 4.00, 'CATERING EQUIPMENT'],
            ['GOBLET', 10.00, 'CATERING EQUIPMENT'],
            ['TEASPOON', 2.00, 'CATERING EQUIPMENT'],
            ['ORDINARY GLASS', 5.00, 'CATERING EQUIPMENT'],
            ['SERVING SPOON', 6.00, 'CATERING EQUIPMENT'],
            ['SERVING FORK', 6.00, 'CATERING EQUIPMENT'],
            ['BAR TRAY', 30.00, 'CATERING EQUIPMENT'],
            ['TONG', 6.00, 'CATERING EQUIPMENT'],
            ['ICE BUCKET', 20.00, 'CATERING EQUIPMENT'],
        ];

        foreach($inventoryItems as $item){
            Inventory::create([
                'item_name' => $item[0],
                'description' => '',
                'category' => $item[2],
                'price' => $item[1],
                'quantity' => random_int(200, 4000),
                'item_img' => null,
            ]);
        }

    }
}
