<?php

namespace Database\Factories;

use App\Models\Grupo;
use Illuminate\Database\Eloquent\Factories\Factory;

class GrupoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Grupo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'nombre'=>$this->faker->name,
            'grado'=>'3',
            'letra'=>'A',
            'turno'=>'-',
            'observacion'=>$this->faker->text,
            'data'=>'',
            'equipo'=>'ILA',
            'ciclo'=>'2020-2021',
        ];
    }
}
