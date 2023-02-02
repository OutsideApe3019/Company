<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TicketFactory extends Factory
{
    public function definition()
    {
        return [
            'reason' => fake()->word(),
            'senderId' => '616',
        ];
    }
}
