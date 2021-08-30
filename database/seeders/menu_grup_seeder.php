<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\MenuGrup\Models\MenuGrup;

class menu_grup_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MenuGrup::create([
            'nm_menu_grup' => 'Menu Utama',
            'icon' => 'fa fa-dashboard',
            'urutan' => 1
        ]);
    }
}
