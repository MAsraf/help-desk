<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Seeders\DateTime;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert(
            array(
                'name' => 'BAHAGIAN SUMBER MANUSIA',
                'floor' => 20,
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            )
        );

        DB::table('departments')->insert(
            array(
                'name' => 'BAHAGIAN PENGURUSAN MAKLUMAT',
                'floor' => 15,
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            )
        );
    }
}
