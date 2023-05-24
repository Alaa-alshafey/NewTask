<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Client A
        Client::create([
            'name' => 'Client A',
            'balance' => 230.5,
        ]);

        // Create Client B
        Client::create([
            'name' => 'Client B',
            'balance' => 600,
        ]);
    }
}
