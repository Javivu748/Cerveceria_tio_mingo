<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Factory para crear usuarios de prueba
 */
class UserFactory extends Factory
{
    // Contraseña que se reutiliza para todos los usuarios creados
    protected static ?string $password;

    /**
     * Define los valores por defecto de un usuario
     */
    public function definition(): array
    {
        return [
            // Nombre del usuario
            'nombre' => fake()->firstName(),

            // Apellido del usuario
            'apellido' => fake()->lastName(),

            // Teléfono de contacto
            'telefono' => fake()->phoneNumber(),

            // Email único
            'email' => fake()->unique()->safeEmail(),

            // Fecha de verificación del email (por defecto ahora)
            'email_verified_at' => now(),

            // Contraseña hasheada
            'password' => static::$password ??= Hash::make('password'),

            // Token para recordar sesión
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Marcar al usuario como no verificado
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
