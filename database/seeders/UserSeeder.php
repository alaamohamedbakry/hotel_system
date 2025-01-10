<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'alaa@mail.com';

        // تحقق من وجود البريد الإلكتروني في جدول admins
        if (!DB::table('admins')->where('email', $email)->exists()) {
            DB::table('admins')->insert([
                'email' => $email,
                'name' => 'alaamohamed',
                'password' => Hash::make('12345678'),  // تأكد من تشفير كلمة المرور
            ]);
        }
    }
}
