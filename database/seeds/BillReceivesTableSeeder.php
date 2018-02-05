<?php

use Illuminate\Database\Seeder;

class BillReceivesTableSeeder extends Seeder
{
    public function run()
    {
        factory(\CodeFin\Models\BillReceive::class, 20)->create();
    }
}
