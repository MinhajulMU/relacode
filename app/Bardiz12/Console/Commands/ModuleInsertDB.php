<?php

namespace App\Bardiz12\Console\Commands;

use App\Modules\Module\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class ModuleInsertDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:seed-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insert all modules to module table in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {


        $modules = config("module.modules");
        $moduleDir = config("module.directory");
        $i = 1;
        foreach ($modules as $module) {
            $i++;
            $routePath = $moduleDir . $module . "/routes.php";
            if (file_exists($routePath)) {
                $slug = Str::snake($module, "-");
                $name = ucwords(str_replace("-", " ", $slug));
                if (Module::where("slug", $slug)->count() === 0) {
                    Module::create([
                        'slug' => $slug,
                        'name' => $name,
                        'icon' => "fa fa-folder",
                        'is_show' => true,
                        'id_menu_grup' => '0ee195cf-24b1-4a57-83fb-4addaebec367',
                        'urutan' => $i,
                        'parent_id' => 0
                    ]);
                }
            }
        }
        return $this->info('seed db:generated');
    }
}
