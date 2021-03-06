<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ClientsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(BankAccountsTableSeeder::class);
        $this->call(BillPayTableSeeder::class);
        $this->call(BillReceivesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);

    }
}
