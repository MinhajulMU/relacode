<?php

namespace App\Bardiz12\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use App\Bardiz12\Eloquent\Helper as EloquentHelper;
use DB;

class ModuleApiGenerateController extends Command
{
    protected $files;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:makeapi {table_name} {--force=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Bikin api controller';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $force = (bool) $this->option("force");
        $table_name = $this->argument('table_name');

        $moduleNameCamel = Str::camel($table_name);
        $moduleNameLower = strtolower($moduleNameCamel);
        $moduleName = ucfirst($moduleNameCamel);
        $moduleSlug = Str::snake($moduleName, "-");
        $moduleTitle = ucwords(str_replace("-", " ", $moduleSlug));

        $root = config('module.directory');
        $moduleDir = $root . $moduleName;
        $controllersDir = $moduleDir . "/Controllers";
        if (!is_dir($moduleDir)) {
            mkdir($moduleDir);
        }
        if (!is_dir($controllersDir)) {
            mkdir($controllersDir);
        }
        $controllerFilePath = $controllersDir . "/" . $moduleName . "ApiController.php";
        $routesFilePath = $moduleDir . "/api.php";
        $replaceCustom = false;
        if (file_exists($controllerFilePath)) {
            if (!$force) {
                return $this->error("CRUD Controller for $moduleName already exists!");
            } else {
                $replaceCustom = true;
            }
        }
        $fields = EloquentHelper::getFieldList($table_name);
        $relations = EloquentHelper::getRelations($table_name);
        $fieldRelations = [];

        $datatableHeader = [];
        foreach ($relations as $relation) {
            $fieldRelations[$relation->COLUMN_NAME] = [
                "ref_table" => $relation->REFERENCED_TABLE_NAME,
                "ref_column" => $relation->REFERENCED_COLUMN_NAME
            ];
        }

        $storeValidator = [];
        $updateValidator = [];
        $tbodyItems = [];
        $forms = [];
        $showBody = [];
        $relationModel = [];
        $relationReference = [];
        $inputField = [];
        $editField = [];
        $storeData = [];
        $updateData = [];

        foreach ($fields['fillable'] as $field_name => $config) {
            $storeRules = [];
            $updateRules = [];
            if ($config['required']) {
                $storeRules[] = "required";
                $updateRules[] = "required";
            } else {
                $storeRules[] = "nullable";
                $updateRules[] = "nullable";
            }

            if ($config["tipe"] == "string") {
                $storeRules[] = "string";
                $storeRules[] = "max:" . $config["length"];
                $updateRules[] = "string";
                $updateRules[] = "max:" . $config["length"];
            } else if ($config["tipe"] == "int") {
                $storeRules[] = "numeric";
                $updateRules[] = "numeric";
            } else if ($config["tipe"] == "date") {
                $storeRules[] = "date";

                $updateRules[] = "date";
            } else if ($config["tipe"] == "time") {
                $storeRules[] = "date_format:H:i";

                $updateRules[] = "date_format:H:i";
            } else if ($config["tipe"] == "datetime") {
                $storeRules[] = "date_format:Y-m-d H:i:s";
                $updateRules[] = "date_format:Y-m-d H:i:s";
            } else if ($config["tipe"] == "text") {
                $storeRules[] = "string";
                $updateRules[] = "string";
            }

            if ($config["column_key"] == "UNI") {
                $storeRules[] = "unique:" . $table_name;
                $updateRules[] = "unique:" . $table_name . "," . $field_name . ",\$id," . $fields["primaryKey"];
            }

            if (isset($fieldRelations[$field_name])) {
                $relasi = $fieldRelations[$field_name];
                $storeRules[] = "exists:" . $relasi['ref_table'] . "," . $relasi['ref_column'];
                $updateRules[] = "exists:" . $relasi['ref_table'] . "," . $relasi['ref_column'];
            }
            $storeValidator[] = '            "' . $field_name . '"       => "' . implode("|", $storeRules) . '"';
            $updateValidator[] = '            "' . $field_name . '"       => "' . implode("|", $updateRules) . '"';
            $storeData[] = '"'.$field_name.'" => $request->input("'.$field_name.'")';
            $updateData[] = '$data->'.$field_name.'= $request->input("'.$field_name.'");';

        }


        $stringStoreValidator = implode(",\n", $storeValidator);
        $stringUpdateValidator = implode(",\n", $updateValidator);
        $stringStoreData = implode(",\n", $storeData);
        $stringUpdateData = implode("\n", $updateData);
        $stubFile = __DIR__ . "/../../../Bardiz12/Stubs/ApiController.php.stub";
        $stub = file_get_contents($stubFile);

        $stub = str_replace("{{moduleName}}", $moduleName, $stub);
        $stub = str_replace("{{moduleNameCamel}}", Str::camel($moduleName), $stub);
        $stub = str_replace("{{primaryKey}}", $fields["primaryKey"], $stub);
        $stub = str_replace("{{storeValidator}}", $stringStoreValidator, $stub);
        $stub = str_replace("{{updateValidator}}", $stringUpdateValidator, $stub);
        $stub = str_replace("{{storeData}}", $stringStoreData, $stub);
        $stub = str_replace("{{updateData}}", $stringUpdateData, $stub);

        $custom = null;
        if ($replaceCustom) {
            $originalFile = file_get_contents($controllerFilePath);
            preg_match_all("/\/\/Start Custom(\n?)(.|\n)+?(\n?)\s+\/\/End Custom/m", $originalFile, $matches);
            $custom = $matches[0][0] ?? null;
        }
        $stub = str_replace("{{custom}}", $custom, $stub);


        $routeStubFile = __DIR__ . "/../../../Bardiz12/Stubs/api.php.stub";
        $writeRoute = true;
        if (file_exists($routesFilePath)) {
            $ask = $this->ask('Route file exists, rewrite ? [y/N]', 'n');
            $ask = strtolower($ask);
            if ($ask === "n") {
                $writeRoute = false;
            }
        }

        file_put_contents($controllerFilePath, $stub);
        $this->info("$moduleName CRUD Controller API created!");
        if ($writeRoute) {
            $routeStub = file_get_contents($routeStubFile);
            file_put_contents($routesFilePath, $routeStub);
            $this->info("API Routes Created!");
        }
    }

    private function getStubFile($filename)
    {
        return __DIR__ . "/../../../Bardiz12/Stubs/" . $filename;
    }

    private function getStub($filename)
    {
        return file_get_contents($this->getStubFile($filename));
    }

    private function stringReplacer($string, $replacement)
    {
        foreach ($replacement as $var => $value) {
            $string = str_replace('{{' . $var . '}}', $value, $string);
        }

        return $string;
    }

    private function convertColumnName($field)
    {
        $parts = explode("_", $field);
        $new = [];
        foreach ($parts as $part) {
            if (!in_array($part, ["id"])) {
                $new[] = ucfirst($part);
            }
        }
        return implode(" ", $new);
    }

}
