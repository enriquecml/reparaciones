<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClienteFactory extends Factory
{

    protected $model= Cliente::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'=>$this->faker->name(),
            'dni_cif'=>$this->faker->dni(),
            'telefono'=>$this->faker->mobileNumber(),
            'email'=>$this->faker->email(),
            'provincia'=>Cliente::ARRAY_PROVINCIAS[rand(0,sizeof(Cliente::ARRAY_PROVINCIAS)-1)],
            'poblacion'=>$this->faker->city(),
            'direccion'=>$this->faker->address(),
            'codigo_postal'=>$this->faker->postcode(),
        ];
    }
}
