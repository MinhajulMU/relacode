<?php

namespace App\Bardiz12\Console\Commands;

use App\Bardiz12\Eloquent\Helper as EloquentHelper;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class ModuleGenerateModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:model {table_name} {--force=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Model from table';

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
        $force = (Bool) $this->option("force");
        $table_name = $this->argument('table_name');
        $moduleName = ucfirst(Str::camel($table_name));
        
        $fields = EloquentHelper::getFieldList($table_name);
        if(count($fields['fillable']) === 0){
            return $this->error("Table not found or doesnt have a ny field");
        }
        
        $root = config('module.directory');
        $moduleDir = $root . $moduleName;
        $modelsDir = $moduleDir . "/Models";
        if( !is_dir($moduleDir)){
            mkdir($moduleDir);
        }

        if( !is_dir($modelsDir)){
            mkdir($modelsDir);
        }
        $modelFilePath = $modelsDir ."/" . $moduleName .".php";
        $replaceCustom = false;
        if(file_exists($modelFilePath)){
            if(!$force){
                return $this->error("Model $moduleName already exists!");
            }else{
                $replaceCustom = true;
            }
        }
        
        $stubFile = __DIR__ ."/../../../Bardiz12/Stubs/Model.php.stub";
        $stub = file_get_contents($stubFile); 

        $stub = str_replace("{{moduleName}}", $moduleName, $stub);
        $stub = str_replace("{{tableName}}", $table_name, $stub);
        $stub = str_replace("{{primaryKey}}", $fields["primaryKey"], $stub);
        
        $fillable = "";
        foreach(array_keys($fields['fillable']) as $key => $item){
            $fillable .= "        \"". $item ."\"" . ($key == count($fields['fillable']) - 1 ? "" : ",\n");
        }

        $stub = str_replace("{{fillable}}", $fillable, $stub);

        $relations = EloquentHelper::getRelations($table_name);

        $relationField = "";
        $relationFieldInject = "";
        foreach($relations as $i => $relation){
            $relationField .= '        "' .$relation->COLUMN_NAME. '" => "' .($relation->REFERENCED_TABLE_NAME . '.' . $relation->REFERENCED_COLUMN_NAME). '"'; ;
            
            $sisterTable = EloquentHelper::getFieldListRaw($relation->REFERENCED_TABLE_NAME);
            $columnInject = $sisterTable[1]->COLUMN_NAME;
            foreach($sisterTable as $key => $col){
                if ($key == 0) continue;
                if($col->DATA_TYPE == "varchar"){
                    $columnInject = $col->COLUMN_NAME;
                    break;
                }
            }
            $relationFieldInject .= '        "' .$relation->COLUMN_NAME. '" => "' .$columnInject. '"';
             if($i < count($relations) - 1){
                // dd($key);
                $relationField.=",\n";
                $relationFieldInject.=",\n";
            }
        }

        $stub = str_replace("{{relationField}}", $relationField, $stub);
        $stub = str_replace("{{relationFieldInject}}", $relationFieldInject, $stub);

        $custom = null;
        if($replaceCustom){
            $originalFile = file_get_contents($modelFilePath);
            preg_match_all("/\/\/Start Custom(\n?)(.|\n)+?(\n?)\s+\/\/End Custom/m", $originalFile, $matches);
            $custom = $matches[0][0] ?? null;
        }
        $stub = str_replace("{{custom}}", $custom, $stub);
        // dd($stub);
        file_put_contents($modelFilePath, $stub);
        
        $this->info("$moduleName Model created!");
        return 0;
    }
}
