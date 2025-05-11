<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
      protected $model = [
            \App\Models\Pasien::class => \Database\Factories\PasienFactory::class,
            \App\Models\Dokter::class => \Database\Factories\DokterFactory::class,
            \App\Models\JadwalKonsultasi::class => \Database\Factories\JadwalKonsultasiFactory::class,
            \App\Models\Obat::class => \Database\Factories\ObatFactory::class,
            \App\Models\Transaksi::class => \Database\Factories\TransaksiFactory::class,
            \App\Models\ResepObat::class => \Database\Factories\ResepObatFactory::class,
        ];
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
