<?php 
namespace App\Bardiz12;

use Livewire\Livewire;
use Illuminate\Support\Facades\App;
use App\Bardiz12\Console\Commands\ModuleGenerate;
use App\Bardiz12\Console\Commands\ModuleInsertDB;
use App\Bardiz12\Console\Commands\ModuleGenerateModel;
use App\Bardiz12\Console\Commands\ModuleLivewireDiscover;
use App\Bardiz12\Console\Commands\ModuleGenerateController;
 
/**
 * ModulesServiceProvider
 * author   : @bardiz12
 * github   : https://github.com/bardiz12
 * web      : https://bardiz.digital
 * phone    : 085712503009
 * email    : dizba.seller@gmail.com
 * You can use this Library Freely, but dont delete the author's comments. :).
 */
class ModulesServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        $modules = config("module.modules");
        $prefix_path = __DIR__."/../../app/Modules";
        foreach($modules as $module){
            if(file_exists($prefix_path.'/'.$module.'/routes.php')) {
                include $prefix_path.'/'.$module.'/routes.php';
            }
            if(is_dir($prefix_path.'/'.$module.'/Views')) {
                $this->loadViewsFrom($prefix_path.'/'.$module.'/Views', $module);
            }
        }
    }

    public function register() {
        if(App::runningInConsole()){
            $this->registerCommands();   
        }
    }

    private function registerCommands(){
        $this->commands([
            ModuleGenerateModel::class,
            ModuleGenerateController::class,
            ModuleInsertDB::class,
            ModuleGenerate::class,
            ModuleLivewireDiscover::class
        ]);
    }

}