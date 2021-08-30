<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Module\Models\Module;

class moduleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $module = Module::create([
            'name' => 'Book',
            'icon' => 'fa fa-folder',
            'slug' => 'book',
            'is_show' => 1,
            'id_menu_grup' => '0ee195cf-24b1-4a57-83fb-4addaebec367',
            'urutan' => 1,
            'parent_id' => 0,
        ]);
    }
}
