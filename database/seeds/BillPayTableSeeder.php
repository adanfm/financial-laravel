<?php

use Illuminate\Database\Seeder;

class BillPayTableSeeder extends Seeder
{
    public function run()
    {
        factory(\CodeFin\Models\BillPays::class, 20)->create();
    }

}