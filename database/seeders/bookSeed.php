<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Book\Models\Book;
use Faker\Factory as Faker;
class bookSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 1000; $i++) { 
            Book::create([
                'id_book' => $faker->uuid,
                'title' => 'tes'.$i,
                'description' => 'wdwdw',
                'id_author' => rand(1,2),
                'allow_pinjam' => rand(0,1)
            ]);
        }
    }
}
