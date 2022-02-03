<?php

namespace Database\Seeders;

use App\Models\Operation;
use Exception;
use Illuminate\Database\Seeder;

class FillOperationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        Operation::factory(300)->create();
    }
}
