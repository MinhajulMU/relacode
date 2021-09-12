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

        $viewsDir = $moduleDir . "/Views";
        if (!is_dir($viewsDir)) {
            mkdir($viewsDir);
        }

        $inertiaDir = $moduleDir . "/Inertia";
        if (!is_dir($inertiaDir)) {
            mkdir($inertiaDir);
        }

        $controllerFilePath = $controllersDir . "/" . $moduleName . "Controller.php";
        $routesFilePath = $moduleDir . "/routes.php";
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
                $relationModel[] = "use App\\Modules\\" . ucfirst(Str::camel($relasi['ref_table'])) . "\\Models\\" . ucfirst(Str::camel($relasi['ref_table'])) . ";";
                $relationField = EloquentHelper::getFieldList($relasi['ref_table']);
                $relationFieldPrimary = $relationField['primaryKey'];
                $relationFieldDesc = array_key_first($relationField['fillable']);
                $relationReference[] = '$data["ref_' . $relasi['ref_table'] . '"] = ' . ucfirst(Str::camel($relasi['ref_table'])) . '::get(["' . $relationFieldPrimary . ' as value","' . $relationFieldDesc . ' as label"]);';
            }
            $storeValidator[] = '            "' . $field_name . '"       => "' . implode("|", $storeRules) . '"';
            $updateValidator[] = '            "' . $field_name . '"       => "' . implode("|", $updateRules) . '"';


            $tbodyItems[] = '        <td>{items.' . $field_name . '}</td>';
            $inputField[] = $field_name . ' : "",';
            $editField[] = $field_name . ' : props.' . $moduleNameCamel . '.'.$field_name.' || "",';
            $fieldNameBeauty = $this->convertColumnName($field_name);
            $tmpShowBody = "        [\n";
            $tmpShowBody .= "            \"name\" => \"$fieldNameBeauty\",\n";
            $tmpShowBody .= "            \"field\" => \"$field_name\",\n";
            $tmpShowBody .= "            \"sortable\" => true,\n";
            $tmpShowBody .= "        ]";
            $datatableHeader[] = $tmpShowBody;
            $forms[] = $this->generateFormInput($fieldNameBeauty, $field_name, $config, $fieldRelations[$field_name] ?? null, $moduleSlug);

            $showBody[] = '<tr>
            <td className="px-4 py-2 align-top">' . $fieldNameBeauty . '</td>
            <td className="px-4 py-2 align-top" width="10px">:</td>
            <td className="px-4 py-2">{data.' . $field_name . '}</td>
        </tr>';
        }
        $tbodyItems = implode("\n", $tbodyItems);
        $forms = implode("\n\n", $forms);
        $datatableHeader = implode(",\n", $datatableHeader);
        $showBody = implode("\n\n", $showBody);
        $stringStoreValidator = implode(",\n", $storeValidator);
        $stringUpdateValidator = implode(",\n", $updateValidator);
        $relationModel = implode("\n", $relationModel);
        $relationReference = implode("\n", $relationReference);
        $inputField = implode("\n", $inputField);
        $editField = implode("\n", $editField);
        $stubFile = __DIR__ . "/../../../Bardiz12/Stubs/Controller.php.stub";
        $stub = file_get_contents($stubFile);

        $stub = str_replace("{{moduleName}}", $moduleName, $stub);
        $stub = str_replace("{{moduleSlug}}", Str::snake($moduleName, "-"), $stub);
        $stub = str_replace("{{moduleNameCamel}}", Str::camel($moduleName), $stub);
        $stub = str_replace("{{primaryKey}}", $fields["primaryKey"], $stub);
        $stub = str_replace("{{storeValidator}}", $stringStoreValidator, $stub);
        $stub = str_replace("{{updateValidator}}", $stringUpdateValidator, $stub);
        $stub = str_replace("{{datatableHeader}}", $datatableHeader, $stub);
        $stub = str_replace("{{RelationModel}}", $relationModel, $stub);
        $stub = str_replace("{{RelationReference}}", $relationReference, $stub);


        $custom = null;
        if ($replaceCustom) {
            $originalFile = file_get_contents($controllerFilePath);
            preg_match_all("/\/\/Start Custom(\n?)(.|\n)+?(\n?)\s+\/\/End Custom/m", $originalFile, $matches);
            $custom = $matches[0][0] ?? null;
        }
        $stub = str_replace("{{custom}}", $custom, $stub);


        $routeStubFile = __DIR__ . "/../../../Bardiz12/Stubs/routes.php.stub";
        $writeRoute = true;
        if (file_exists($routesFilePath)) {
            $ask = $this->ask('Route file exists, rewrite ? [y/N]', 'n');
            $ask = strtolower($ask);
            if ($ask === "n") {
                $writeRoute = false;
            }
        }

        //create Views

        //start View Stub
        $indexViewStub = $this->getStub("Inertia/Index.js.stub");
        $showViewStub = $this->getStub("Inertia/Show.js.stub");
        $editViewStub = $this->getStub("Inertia/Edit.js.stub");
        $createViewStub = $this->getStub("Inertia/Create.js.stub");
        $formViewStub = $this->getStub("Inertia/Form.js.stub");

        $vars = [
            'moduleTitle' => $moduleTitle,
            'moduleName' => $moduleName,
            'moduleSlug' => $moduleSlug,
            'moduleNameCamel' => $moduleNameCamel,
            'primaryKey' => $fields["primaryKey"],
            'tbodyItems' => $tbodyItems,
            'forms' => $forms,
            'showBody' => $showBody,
            'inputField' => $inputField,
            'editField' => $editField
        ];

        $indexViewStub = $this->stringReplacer($indexViewStub, $vars);
        $indexViewFilePath = $inertiaDir . "/Index.js";

        $formViewStub = $this->stringReplacer($formViewStub, $vars);
        $formViewFilePath = $inertiaDir . "/Form.js";

        $showViewStub = $this->stringReplacer($showViewStub, $vars);
        $showViewFilePath = $inertiaDir . "/Show.js";

        $updateViewStub = $this->stringReplacer($editViewStub, $vars);
        $updateViewFilePath = $inertiaDir . "/Edit.js";

        $createViewStub = $this->stringReplacer($createViewStub, $vars);
        $createViewFilePath = $inertiaDir . "/Create.js";





        file_put_contents($controllerFilePath, $stub);
        $this->info("$moduleName CRUD Controller created!");
        if ($writeRoute) {
            $routeStub = file_get_contents($routeStubFile);
            file_put_contents($routesFilePath, $routeStub);
            $this->info("Routes Created!");
        }
        file_put_contents($indexViewFilePath, $indexViewStub);
        file_put_contents($formViewFilePath, $formViewStub);
        file_put_contents($showViewFilePath, $showViewStub);
        file_put_contents($updateViewFilePath, $updateViewStub);
        file_put_contents($createViewFilePath, $createViewStub);
        $this->info("all view created!");

        // $this->info($stub);
    }

    private function createIndexView()
    {
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

    private function generateFormInput($beautyName, $field, $config, $relation, $moduleSlug)
    {

        $required = $config['required'] ? " required" : "";
        if ($relation != null) {
            return '<Select2
                    label="' . $beautyName . '"
                    name="' . $field . '"
                    errors={props.errors.' . $field . '}
                    data={props.ref_' . $relation['ref_table'] . '}
                    selected={data.' . $field . '}
                    onChange={selectedOption =>
                    setData("' . $field . '", selectedOption.value)
                    }
                ></Select2>';
        }

        if (in_array($config['tipe'], ["datetime", "date", "time", "boolean", "timestamp","tinyint"])) {
            if ($config['tipe'] == "datetime" || $config['tipe'] == "timestamp") {
                return '<DateInput
                    type="datetime"
                    label="' . $beautyName . '"
                    name="' . $field . '"
                    errors={props.errors.' . $field . '}
                    value={data.' . $field . '}
                    onChange={(e,dateString) => setData("' . $field . '", dateString)}
                    />';
            } else if ($config['tipe'] == "time") {
                return '<DateInput
                    type="time"
                    label="' . $beautyName . '"
                    name="' . $field . '"
                    errors={props.errors.' . $field . '}
                    value={data.' . $field . '}
                    onChange={(e,dateString) => setData("' . $field . '", dateString)}
                    />';
            } else if ($config['tipe'] == "date") {
                return '<DateInput
                    type="date"
                    label="' . $beautyName . '"
                    name="' . $field . '"
                    errors={props.errors.' . $field . '}
                    value={data.' . $field . '}
                    onChange={(e,dateString) => setData("' . $field . '", dateString)}
                    />';
            } else if ($config['tipe'] == "boolean" || $config['tipe'] == "tinyint") {
                return '<Radio
                    label="' . $beautyName . '"
                    name="' . $field . '"
                    errors={props.errors.' . $field . '}
                    value={data.' . $field . '}
                    choises={[
                    {
                        key: 0,
                        value: "Tidak",
                    },
                    {
                        key: 1,
                        value: "Ya",
                    },
                    ]}
                    onChange={(e) => setData("' . $field . '", e.target.value)}
                ></Radio>';
            }
        } else {
            $tipe = "";
            if ($config['tipe'] == "text") {
                return ' <TextareaInput
                    label="' . $beautyName . '"
                    name="' . $field . '"
                    errors={props.errors.' . $field . '}
                    value={data.' . $field . '}
                    onChange={e => setData("' . $field . '", e.target.value)}
                />';
            }

            if ($config['tipe'] == "int") {
                $tipe = "number";
            } else {
                $tipe = "text";
            }
            return ' <TextInput
                type="' . $tipe . '"
                label="' . $beautyName . '"
                name="' . $field . '"
                errors={props.errors.' . $field . '}
                value={data.' . $field . '}
                onChange={e => setData("' . $field . '", e.target.value)}
            />';
        }
    }
}
