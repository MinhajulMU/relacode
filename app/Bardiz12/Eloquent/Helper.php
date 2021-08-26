<?php

namespace App\Bardiz12\Eloquent;

use Illuminate\Support\Facades\DB;

/**
 * Eloquent\Helper
 * author   : @bardiz12
 * github   : https://github.com/bardiz12
 * web      : https://bardiz.digital
 * phone    : 085712503009
 * email    : dizba.seller@gmail.com
 * You can use this Library Freely, but dont delete the author's comments. :).
 */

class Helper{
    protected static $DBCONFIG = null;
    public static function getDBConfig(){
        if(self::$DBCONFIG == null){
            $db = config("database");

            self::$DBCONFIG = $db["connections"][$db['default']];
        }
        return self::$DBCONFIG;
    }

    public static function getRelations($table_name){
        $dbName = self::getDBConfig()['database'];
        return DB::select("select * from information_schema.KEY_COLUMN_USAGE where TABLE_SCHEMA='".$dbName."' and TABLE_NAME='" .$table_name. "' and REFERENCED_TABLE_NAME is not null");
    }

    public static function getFieldListRaw($table_name){
        $dbName = self::getDBConfig()['database'];
        return DB::select("SELECT * FROM `INFORMATION_SCHEMA`.`COLUMNS`
        WHERE TABLE_NAME = '$table_name' and TABLE_SCHEMA = '$dbName' ");
    }
    

    public static function getFieldList($table_name){
        $raw = self::getFieldListRaw($table_name);
        $primaryKey = "";
        $fillable = [];
        foreach($raw as $field){
            
            if($field->COLUMN_KEY == "PRI"){
                $primaryKey = $field->COLUMN_NAME;
            }else if(!in_array($field->COLUMN_NAME,['created_at','updated_at','deleted_at'])){
                $tipe = "string";
                switch ($field->DATA_TYPE) {
                    case 'varchar':
                        $tipe = "string";
                        break;
                    
                    case 'tinyint':
                        $tipe = $field->COLUMN_TYPE == "tinyint(1)" ? "boolean" : "int";
                        break;

                    default:
                        $tipe = $field->DATA_TYPE;
                        break;
                }
                $length = $field->CHARACTER_MAXIMUM_LENGTH;
                $column_key = $field->COLUMN_KEY;
                $required = !($field->IS_NULLABLE == "YES" && $field->COLUMN_DEFAULT == null);
                $fillable[$field->COLUMN_NAME] = compact("tipe", "length", "column_key", "required");
            }
        }
        return compact("primaryKey","fillable");
    }
}