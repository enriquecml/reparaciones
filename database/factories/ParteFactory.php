<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parte>
 */
class ParteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente_id'=>$this->faker->numberBetween(1,Cliente::max('id')),
            'numero'=>$this->faker->randomNumber(3)+1,
            'fecha'=>$this->faker->date(),
            'maquina'=>$this->faker->word(),
            'averia'=>$this->faker->paragraph(),
            'reparacion'=>$this->faker->paragraph(),
            'mano_obra'=>$this->faker->randomFloat(2,0,1000),
            'desplazamiento'=>$this->faker->randomFloat(2,0,1000),
            'portes'=>$this->faker->randomFloat(2,0,1000),
            'materiales'=>$this->faker->randomFloat(2,0,1000),
            'iva'=>21
        ];
    }
}
