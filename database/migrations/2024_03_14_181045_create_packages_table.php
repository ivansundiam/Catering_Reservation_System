<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Package;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $packages = [
            ['name' => 'Wedding Elegant Sapphire Package'],
            ['name' => 'Wedding Elegant Silver Package'],
            ['name' => 'Wedding Elegant Tiffany Package'],
            ['name' => 'Wedding Elegant Ruby Package'],
            ['name' => 'Wedding Elegant Gold Package'],
            ['name' => 'Debut Elegant Sapphire Package'],
            ['name' => 'Debut Elegant Silver Package'],
            ['name' => 'Debut Elegant Tiffany Package'],
            ['name' => 'Debut Elegant Ruby Package'],
            ['name' => 'Debut Elegant Gold Package'],
            ['name' => 'Dinner / Lunch Buffet (Ordinary)'],
            ['name' => 'Dinner / Lunch Buffet (Special)'],
        ];

        foreach($packages as $package){
            Package::create($package);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
