<?php

namespace App\Bardiz12\Console\Commands;

use Illuminate\Console\Command;

class ModuleGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:make {table_name} {--force=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Model, Controller, and Livewire for Table';

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
        $force = $this->option("force");
        $table_name = $this->argument('table_name');
        $params = [
                "table_name" => $table_name,
                "--force" => $force
            ];
        //1. create Model
        $this->call("modules:model", $params);
        $this->call("modules:crud", $params);
        $this->call("modules:seed-db");
        return 0;
    }
}
