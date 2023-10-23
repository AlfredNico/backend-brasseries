<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Site;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Departement>
 */
class DepartementFactory extends Factory
{
    static $order = 1;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'site_id' => Site::all()->random()->ids,
            'name'   => 'Depart ' . self::$order++,
        ];
    }
}
