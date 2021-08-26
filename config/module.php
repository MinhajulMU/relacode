<?php

use Illuminate\Support\Str;

$directory = __DIR__ . '/../app/Modules/';
$folder = glob($directory . "*", GLOB_ONLYDIR);

$data = array();
$livewires = [];
foreach ($folder as $file) {
	$parts = explode("/", $file);
	$moduleFolder = end($parts);
	$livewire_dir = $directory  . $moduleFolder . "/Livewire";
	$data[] = $moduleFolder;
	if (is_dir($livewire_dir)) {
		$files = glob($livewire_dir . "/*");
		foreach ($files as $file) {
			if (substr($file, strlen($file) - 4) === ".php") {
				$nameSpace = substr("\App\Modules\\" . str_replace("/", "\\", str_replace($directory, "", $file)), 0, -4);
				$parts = explode("\\", str_replace($livewire_dir, "", $nameSpace));
				$className = end($parts);
				$livewires[Str::snake($moduleFolder,"-") . "-" . Str::snake($className,"-")] = $nameSpace;
			// 	Livewire::component($module . '::' . $fileName, $className);
			}
		}
	}
}



$result = [
	"directory" => $directory,
	"livewires" => $livewires,
	"dir_vue" => "../../../app/Modules/",
	"modules-js" => __DIR__ . "/../resources/js/src/modules.js",
	'modules' => $data,
	"menus-js" => __DIR__ . "/../resources/js/src/menus.js",
];

return  $result;
