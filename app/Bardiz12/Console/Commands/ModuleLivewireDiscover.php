<?php

namespace App\Bardiz12\Console\Commands;

use Illuminate\Console\Command;

class ModuleLivewireDiscover extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:discover';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Discover Livewire in Modules';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call("livewire:discover");
        $bootstrap_file = app_path() ."/../bootstrap/cache/livewire-components.php";
        $components = require_once($bootstrap_file);
        $components = array_merge(
            $components,
            config("module.livewires")
        );
        file_put_contents($bootstrap_file, "<?php return ".var_export($components,true)."; ");
    }
}
