<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProxyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ip_address' => fake()->ipv4,
            'protocol' => fake()->randomElement(['http', 'socks5']),
            'country' => fake()->countryCode,
            'speed' => '',
            'completed_at' => now(),
        ];
    }
}
