<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();

        for ($i=0; $i < 50; $i++) {
            DB::table('books')->insert([
                'title' => $faker->sentence(1),
                'body' => $faker->paragraph(1),
                'tags' => join(',',$faker->words(3))
                        ]);
        }
    }
}
