<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UpdatePasswordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = User::where('email', 'siswa@edtech.com')->first();
        if ($siswa) {
            $siswa->update(['password' => 'password']);
        }

        $admin = User::where('email', 'admin@edtech.com')->first();
        if ($admin) {
            $admin->update(['password' => 'password']);
        }
    }
}
