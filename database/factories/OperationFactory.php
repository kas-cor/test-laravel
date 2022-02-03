<?php

namespace Database\Factories;

use App\Models\Operation;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Inspiring;

class OperationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition()
    {
        return [
            'user_id' => random_int(1, 10),
            'sum' => random_int(100, 1000),
            'description' => Inspiring::quote(),
            'created_at' => date('Y-m-d H:i:s', time() - random_int(1, 31) * 60 * 60 * 24),
            'updated_at' => date('Y-m-d H:i:s', time() - random_int(1, 31) * 60 * 60 * 24),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Operation $operation) {
            $timestamp = date('Y-m-d H:i:s', time() + $operation->id * 60);
            $operation->created_at = $timestamp;
            $operation->updated_at = $timestamp;
            $operation->save();
        });
    }

}
