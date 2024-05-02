<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = $this->faker->randomElement(['Category 1', 'Category 2', 'Category 3', 'Category 4']); 
        $itemName = $this->faker->word;

        // Check if the generated item name already exists, generate a new one until it's unique
        while (\App\Models\Inventory::where('item_name', $itemName)->exists()) {
            $itemName = $this->faker->word;
        }
        $itemNames = $this->faker->unique()->randomElement(['Item 1', 'Item 2', 'Item 3', 'Item 4']); 

        return [
            'item_name' => $itemNames,
            'description' => $this->faker->sentence,
            'category' => $category,
            'quantity' => $this->faker->numberBetween(100, 1000),
            'item_img' => null, 
        ];
    }
}
