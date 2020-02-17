<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(customers)->insert([
            'name' => Str::random(10),
            'email'=> Str::random(10). @gmail.com,
            'number' => int::random(8),
            ]);
    }
}
