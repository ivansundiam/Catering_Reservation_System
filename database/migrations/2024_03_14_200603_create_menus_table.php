<?php

use App\Models\Menu;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });

        $menus = [
            ['package_id' => 1, 'name' => 'A', 'price' => 590.00],
            ['package_id' => 1, 'name' => 'B', 'price' => 590.00],
            ['package_id' => 1, 'name' => 'C', 'price' => 590.00],

            ['package_id' => 2, 'name' => 'A', 'price' => 670.00],
            ['package_id' => 2, 'name' => 'B', 'price' => 670.00],
            ['package_id' => 2, 'name' => 'C', 'price' => 670.00],

            ['package_id' => 3, 'name' => 'A', 'price' => 770.00],
            ['package_id' => 3, 'name' => 'B', 'price' => 770.00],
            ['package_id' => 3, 'name' => 'C', 'price' => 770.00],

            ['package_id' => 4, 'name' => 'A', 'price' => 870.00],
            ['package_id' => 4, 'name' => 'B', 'price' => 870.00],
            ['package_id' => 4, 'name' => 'C', 'price' => 870.00],

            ['package_id' => 5, 'name' => 'A', 'price' => 1500.00],
            ['package_id' => 5, 'name' => 'B', 'price' => 1500.00],
            ['package_id' => 5, 'name' => 'C', 'price' => 1500.00],

            ['package_id' => 6, 'name' => 'A', 'price' => 590.00],
            ['package_id' => 6, 'name' => 'B', 'price' => 590.00],
            ['package_id' => 6, 'name' => 'C', 'price' => 590.00],

            ['package_id' => 7, 'name' => 'A', 'price' => 670.00],
            ['package_id' => 7, 'name' => 'B', 'price' => 670.00],
            ['package_id' => 7, 'name' => 'C', 'price' => 670.00],

            ['package_id' => 8, 'name' => 'A', 'price' => 770.00],
            ['package_id' => 8, 'name' => 'B', 'price' => 770.00],
            ['package_id' => 8, 'name' => 'C', 'price' => 770.00],

            ['package_id' => 9, 'name' => 'A', 'price' => 870.00],
            ['package_id' => 9, 'name' => 'B', 'price' => 870.00],
            ['package_id' => 9, 'name' => 'C', 'price' => 870.00],

            ['package_id' => 10, 'name' => 'A', 'price' => 1500.00],
            ['package_id' => 10, 'name' => 'B', 'price' => 1500.00],
            ['package_id' => 10, 'name' => 'C', 'price' => 1500.00],
            
            ['package_id' => 11, 'name' => 'A', 'price' => 320.00],
            ['package_id' => 11, 'name' => 'B', 'price' => 320.00],
            ['package_id' => 11, 'name' => 'C', 'price' => 320.00],
            ['package_id' => 11, 'name' => 'D', 'price' => 330.00],
            ['package_id' => 11, 'name' => 'E', 'price' => 330.00],
            ['package_id' => 11, 'name' => 'F', 'price' => 330.00],
            ['package_id' => 11, 'name' => 'G', 'price' => 400.00],
            ['package_id' => 11, 'name' => 'H', 'price' => 400.00],
            ['package_id' => 11, 'name' => 'I', 'price' => 400.00],

            ['package_id' => 12, 'name' => 'A', 'price' => 390.00],
            ['package_id' => 12, 'name' => 'B', 'price' => 450.00],
            ['package_id' => 12, 'name' => 'C', 'price' => 560.00],
            ['package_id' => 12, 'name' => 'D', 'price' => 450.00],
            ['package_id' => 12, 'name' => 'E', 'price' => 500.00],
            ['package_id' => 12, 'name' => 'F', 'price' => 580.00],
            ['package_id' => 12, 'name' => 'G', 'price' => 400.00],
            ['package_id' => 12, 'name' => 'H', 'price' => 420.00],
            ['package_id' => 12, 'name' => 'I', 'price' => 560.00],
        ];
        
        foreach($menus as $item)
        {
            Menu::create($item);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
