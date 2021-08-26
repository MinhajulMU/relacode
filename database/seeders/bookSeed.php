<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
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
        for ($i=0; $i < 1000; $i++) { 
            Book::create([
                'title' => 'tes'.$i,
                'description' => 'wdwdw',
                'id_author' => rand(1,2)
            ]);
        }
    }
}
