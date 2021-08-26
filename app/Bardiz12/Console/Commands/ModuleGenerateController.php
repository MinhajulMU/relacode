<?php

namespace App\Bardiz12\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use App\Bardiz12\Eloquent\Helper as EloquentHelper;

class ModuleGenerateController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modules:crud {table_name} {--force=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate CRUD Controller, Route, and View';

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
       
        $moduleNameCamel = Str::camel($table_name);
        $moduleNameLower = strtolower($moduleNameCamel);
        $moduleName = ucfirst($moduleNameCamel);
        $moduleSlug = Str::snake($moduleName,"-");
        $moduleTitle = ucwords(str_replace("-"," ",$moduleSlug));
        
        
        $root = config('module.directory');
        $moduleDir = $root . $moduleName;
        $controllersDir = $moduleDir . "/Controllers";
        if( !is_dir($moduleDir)){
            mkdir($moduleDir);
        }

        if( !is_dir($controllersDir)){
            mkdir($controllersDir);
        }

        $viewsDir = $moduleDir . "/Views";
        if( !is_dir($viewsDir)){
            mkdir($viewsDir);
        }

        $livewireDir = $moduleDir . "/Livewire";
        if( !is_dir($livewireDir)){
            mkdir($livewireDir);
        }

        $livewireViewDir = $viewsDir . "/livewire";
        if( !is_dir($livewireViewDir)){
            mkdir($livewireViewDir);
        }

        $controllerFilePath = $controllersDir ."/" . $moduleName ."Controller.php";
        $routesFilePath = $moduleDir ."/routes.php";
        $replaceCustom = false;
        if(file_exists($controllerFilePath)){
            if(!$force){
                return $this->error("CRUD Controller for $moduleName already exists!");
            }else{
                $replaceCustom = true;
            }
        }

        $fields = EloquentHelper::getFieldList($table_name);

        $relations = EloquentHelper::getRelations($table_name);
        $fieldRelations = [];

        $datatableHeader = [];
        foreach($relations as $relation){
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
        foreach($fields['fillable'] as $field_name => $config){
            $storeRules = [];
            $updateRules = [];
            if($config['required']){
                $storeRules[] = "required";
                
                $updateRules[] = "required";
            }else{
                $storeRules[] = "nullable";
                
                $updateRules[] = "nullable";
            }

            if($config["tipe"] == "string"){
                $storeRules[] = "string";
                $storeRules[] = "max:" . $config["length"];

                $updateRules[] = "string";
                $updateRules[] = "max:" . $config["length"];
            }else if($config["tipe"] == "int"){
                $storeRules[] = "numeric";

                $updateRules[] = "numeric";
            }else if($config["tipe"] == "date"){
                $storeRules[] = "date";

                $updateRules[] = "date";
            }else if($config["tipe"] == "time"){
                $storeRules[] = "date_format:H:i";

                $updateRules[] = "date_format:H:i";
            }else if($config["tipe"] == "datetime"){
                $storeRules[] = "date_format:Y-m-d H:i:s";

                $updateRules[] = "date_format:Y-m-d H:i:s";
            }else if($config["tipe"] == "text"){
                $storeRules[] = "string";

                $updateRules[] = "string";
            }

            if($config["column_key"] == "UNI"){
                $storeRules[] = "unique:".$table_name;

                $updateRules[] = "unique:".$table_name .",".$field_name.",\$id,".$fields["primaryKey"];
            }

            if(isset($fieldRelations[$field_name])){
                $relasi = $fieldRelations[$field_name];
                $storeRules[] = "exists:".$relasi['ref_table'] .",".$relasi['ref_column'];

                $updateRules[] = "exists:".$relasi['ref_table'] .",".$relasi['ref_column'];
            }
            $storeValidator[] = '            "'.$field_name.'"       => "' . implode("|",$storeRules) .'"';
            $updateValidator[] = '            "'.$field_name.'"       => "' . implode("|",$updateRules) .'"';


            $tbodyItems[] = '        <td class="px-4 py-3">
            {{ ($item->'.$field_name.') }}
        </td>';
            $fieldNameBeauty = $this->convertColumnName($field_name);
            $tmpShowBody = "        [\n";
            $tmpShowBody.= "            \"name\" => \"$fieldNameBeauty\",\n";
            $tmpShowBody.= "            \"field\" => \"$field_name\",\n";
            $tmpShowBody.= "            \"sortable\" => true,\n";
            $tmpShowBody.= "        ]";
            $datatableHeader[] = $tmpShowBody;

            $forms[] = $this->generateFormInput($fieldNameBeauty, $field_name, $config, $fieldRelations[$field_name] ?? null, $moduleSlug);
            $showBody[] = '<tr>
            <td class="px-4 py-2 align-top">'.$fieldNameBeauty.'</td>
            <td class="px-4 py-2 align-top" width="10px">:</td>
            <td class="px-4 py-2">{{$'.$moduleNameCamel.'->'.$field_name.'}}</td>
        </tr>';

        }

        $tbodyItems = implode("\n", $tbodyItems);
        $forms = implode("\n\n", $forms);
        $datatableHeader = implode(",\n", $datatableHeader);
        $showBody = implode("\n\n",$showBody);

        $stringStoreValidator = implode(",\n", $storeValidator);
        $stringUpdateValidator = implode(",\n", $updateValidator);

        $stubFile = __DIR__ ."/../../../Bardiz12/Stubs/Controller.php.stub";
        $stub = file_get_contents($stubFile); 

        $stub = str_replace("{{moduleName}}", $moduleName, $stub);
        $stub = str_replace("{{moduleSlug}}", Str::snake($moduleName,"-"), $stub);
        $stub = str_replace("{{moduleNameCamel}}", Str::camel($moduleName), $stub);
        $stub = str_replace("{{tableName}}", $table_name, $stub);
        $stub = str_replace("{{primaryKey}}", $fields["primaryKey"], $stub);

        $stub = str_replace("{{storeValidator}}", $stringStoreValidator, $stub);
        $stub = str_replace("{{updateValidator}}", $stringUpdateValidator, $stub);

        $custom = null;
        if($replaceCustom){
            $originalFile = file_get_contents($controllerFilePath);
            preg_match_all("/\/\/Start Custom(\n?)(.|\n)+?(\n?)\s+\/\/End Custom/m", $originalFile, $matches);
            $custom = $matches[0][0] ?? null;
        }
        $stub = str_replace("{{custom}}", $custom, $stub);


        $routeStubFile = __DIR__ ."/../../../Bardiz12/Stubs/routes.php.stub";
        $writeRoute = true;
        if(file_exists($routesFilePath)){
            $ask = $this->ask('Route file exists, rewrite ? [y/N]', 'n');
            $ask = strtolower($ask);
            if($ask === "n"){
                $writeRoute = false;
            }
        }

        

        //create Views
        
        //start View Stub
        $indexViewStub = $this->getStub("Views/index.blade.php.stub");
        $datatableViewStub = $this->getStub("Views/datatable.blade.php.stub");
        $showViewStub = $this->getStub("Views/show.blade.php.stub");
        $updateViewStub = $this->getStub("Views/edit.blade.php.stub");
        $createViewStub = $this->getStub("Views/create.blade.php.stub");
        $formViewStub = $this->getStub("Views/form.blade.php.stub");
        

        $vars = [
            'moduleTitle' => $moduleTitle,
            'moduleName' => $moduleName,
            'moduleNameLower' => $moduleNameLower,
            'moduleNameCamel' => $moduleNameCamel,
            'moduleSlug' => $moduleSlug,
            'primaryKey' => $fields["primaryKey"],
            'tbodyItems' => $tbodyItems,
            'forms' => $forms,
            'showBody' => $showBody,
            'datatableHeader' => $datatableHeader
        ];

        $indexViewStub = $this->stringReplacer($indexViewStub, $vars);
        $indexViewFilePath = $viewsDir . "/index.blade.php";

        

        $datatableViewStub = $this->stringReplacer($datatableViewStub, $vars);
        $datatableViewFilePath = $viewsDir . "/livewire/datatable.blade.php";
         

        $formViewStub = $this->stringReplacer($formViewStub, $vars);
        $formViewFilePath = $viewsDir . "/form.blade.php";

        $showViewStub = $this->stringReplacer($showViewStub, $vars);
        $showViewFilePath = $viewsDir . "/show.blade.php";

        $updateViewStub = $this->stringReplacer($updateViewStub, $vars);
        $updateViewFilePath = $viewsDir . "/edit.blade.php";

        $createViewStub = $this->stringReplacer($createViewStub, $vars);
        $createViewFilePath = $viewsDir . "/create.blade.php";

        
       
        //end view
        
        //create Livewire datatable
        $datatableStub = $this->getStub("datatable.php.stub");
        $datatableStub = $this->stringReplacer($datatableStub, $vars);
        $datatableFilePath = $livewireDir . "/".$moduleName."Datatable.php";
        
        file_put_contents($controllerFilePath, $stub);
        $this->info("$moduleName CRUD Controller created!");
        if($writeRoute){
            $routeStub = file_get_contents($routeStubFile);
            file_put_contents($routesFilePath, $routeStub);
            $this->info("Routes Created!");
        }
        file_put_contents($indexViewFilePath, $indexViewStub);
        file_put_contents($datatableViewFilePath, $datatableViewStub);
        file_put_contents($formViewFilePath, $formViewStub);
        file_put_contents($showViewFilePath, $showViewStub);
        file_put_contents($updateViewFilePath, $updateViewStub);
        file_put_contents($createViewFilePath, $createViewStub);
        file_put_contents($datatableFilePath, $datatableStub);
        $this->info("all view created!");

        // $this->info($stub);
    }
    
    private function createIndexView(){
        
    }

    private function getStubFile($filename){
        return __DIR__ ."/../../../Bardiz12/Stubs/".$filename;
    }

    private function getStub($filename){
        return file_get_contents($this->getStubFile($filename));
    }

    private function stringReplacer($string, $replacement){
        foreach($replacement as $var => $value){
            $string = str_replace('{{'.$var.'}}', $value, $string);
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

    private function generateFormInput($beautyName, $field, $config, $relation, $moduleSlug)
    {

        $required = $config['required'] ? " required" : "";
        if ($relation != null) {
            return '<x-form.input-container>
            <x-form.label>'.$beautyName.'</x-form.label>
            <x-select2 :url="route(\''.$moduleSlug.'.combo.read\')" field="'.$field.'" name="'.$field.'" initial-id="{{old(\''.$field.'\',isset($model) ? $model->'.$field.' : null)}}" required></x-select2>
        </x-form.input-container>';
        }

        if (in_array($config['tipe'], ["datetime", "date", "time", "boolean", "timestamp"])) {
            if ($config['tipe'] == "datetime" || $config['tipe'] == "timestamp") {
                return '<x-form.input-container>
                <x-form.label for="'.$field.'">
                    '.$beautyName.'
                </x-form.label>
                <x-form.input name="'.$field.'" value="{{old(\''.$field.'\', isset($model) ? $model->'.$field.' : null)}}" type="datetime-local"'.$required.'/>
            </x-form.input-container>';
            } else if ($config['tipe'] == "time") {
                return '<x-form.input-container>
                <x-form.label for="'.$field.'">
                    '.$beautyName.'
                </x-form.label>
                <x-form.input name="'.$field.'" value="{{old(\''.$field.'\', isset($model) ? $model->'.$field.' : null)}}" type="time"'.$required.'/>
            </x-form.input-container>';
            } else if ($config['tipe'] == "date") {
                return '<x-form.input-container>
                <x-form.label for="'.$field.'">
                    '.$beautyName.'
                </x-form.label>
                <x-form.input name="'.$field.'" value="{{old(\''.$field.'\', isset($model) ? $model->'.$field.' : null)}}" type="date"'.$required.'/>
            </x-form.input-container>';
            } else if ($config['tipe'] == "boolean") {
                return '<x-form.input-container>
                <x-form.label for="'.$field.'">
                    '.$beautyName.'
                </x-form.label>
                <x-form.radios name="'.$field.'" :choices="[\'1\' => \'Ya\', \'0\' => \'Tidak\']" value="{{old(\''.$field.'\',isset($model) ? $model->'.$field.' : \'0\')}}"'.$required.'/>
            </x-form.input-container>';
            }
        } else {
            $tipe = "";
            if ($config['tipe'] == "text") {
                return '<x-form.input-container>
                <x-form.label for="'.$field.'">
                    '.$beautyName.'
                </x-form.label>
                <x-form.text name="'.$field.'" required>{{old(\''.$field.'\', isset($model) ? $model->'.$field.' : null)}}</x-form.text>
            </x-form.input-container>';
            }

            if ($config['tipe'] == "int") {
                $tipe = "number";
            } else {
                $tipe = "text";
            }
            return '<x-form.input-container>
                <x-form.label for="'.$field.'">
                    '.$beautyName.'
                </x-form.label>
                <x-form.input name="'.$field.'" value="{{old(\''.$field.'\', isset($model) ? $model->'.$field.' : null)}}" type="'.$tipe.'"'.$required.'/>
            </x-form.input-container>';
        }
    }

}
