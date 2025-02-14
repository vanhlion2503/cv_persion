<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Sửa namespace đúng
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([ 
            'name' => 'VietAnh',
            'email' => 'lionntva25@gmail.com', // Thay thế bằng email
            'password' => Hash::make('123456789'), // Thay thế bằng mật khẩu
        ]);

    }
}
