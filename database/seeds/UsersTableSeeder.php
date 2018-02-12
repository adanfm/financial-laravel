<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $repository = app(\CodeFin\Repositories\ClientRepository::class);
        $clients = $repository->all();

        factory(\CodeFin\Models\User::class, 1)
            ->states('admin')
            ->create([
                'name'  => 'Adan Felipe Medeiros',
                'email' => 'adan.grg@gmail.com',
            ]);
        ;

        foreach (range(1, 50) as $value) {
            factory(\CodeFin\Models\User::class, 1)
                ->create([
                    'name'  =>  "Client da Silva n $value",
                    'email' =>  "client$value@user.com",
                ])
                ->each(function ($user) use($clients) {
                    $client = $clients->random();
                    $user->client()->associate($client);
                    $user->save();
                })
            ;
        }
    }
}
