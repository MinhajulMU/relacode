<?php


$directory = __DIR__ . '/../app/Modules/';
$folder = glob($directory . "*", GLOB_ONLYDIR);

$data = array();
foreach ($folder as $file) {
	$parts = explode("/", $file);
	$moduleFolder = end($parts);
	$data[] = $moduleFolder;
}
$result = [
	"directory" => $directory,
	'modules' => $data,
];

return  $result;
