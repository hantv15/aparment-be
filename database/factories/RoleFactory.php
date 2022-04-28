<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Nhân viên'],
            ['name' => 'Người dùng'],
        ];
        return $roles;
    }
}
