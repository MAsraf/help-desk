<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Seeders\DateTime;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            array(
                'name' => 'MOHAMMAD NADZMI BIN MD PADZI',
                'email' => 'nadzmi@myipo.gov.my',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'department_id' => 2,
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'NUR SALFIZA BINTI SHAARI',
                'email' => 'fiza@myipo.gov.my',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'department_id' => 2,
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'MOHD. HAIRUNIZAM BIN MOHD FAUZI',
                'email' => 'mohaizam@myipo.gov.my',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'department_id' => 2,
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'JOHARI BIN MD. NOR',
                'email' => 'johari@myipo.gov.my',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'department_id' => 2,
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'FAIZUL HAFIZ BIN MOHD. SHAMSUDDIN',
                'email' => 'faizul@myipo.gov.my',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'department_id' => 2,
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'MOHAMMAD FAKHARUDDIN BIN MOHAMAD ZIN',
                'email' => 'fakharuddin@myipo.gov.my',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'department_id' => 1,
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'Syariff Ghani',
                'email' => 'syariffghani@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'department_id' => 1,
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'Nurul Khaliesah',
                'email' => 'khaliesah@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'department_id' => 1,
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'Haikal Handali',
                'email' => 'haikal@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'department_id' => 1,
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'Hazmie Khalid',
                'email' => 'hazmie@gmail.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'department_id' => 1,
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            )
        );
    }
}
