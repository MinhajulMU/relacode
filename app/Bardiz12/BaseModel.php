<?php

namespace App\Bardiz12;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * BaseModel
 * author   : @bardiz12
 * github   : https://github.com/bardiz12
 * web      : https://bardiz.digital
 * phone    : 085712503009
 * email    : dizba.seller@gmail.com
 * You can use this Library Freely, but dont delete the author's comments. :).
 */
class BaseModel extends Model
{

    use SoftDeletes;

    /**
     * author @bardiz12
     * @var Array $relationField
     * assosiative array of foreign table and it's foreign key. format : current table's foreign_key as it key and foreign table's name and foreign table's primary_key separated with dot as it value. 
     * 
     * example : [
     *      "id_author" => "authors.id_author"
     * ]
     */
    protected $relationField = [];

    /**
     * author @bardiz12
     * @var Integer $paginationSize
     * default size of pagination
     */
    protected $paginationSize = 10;

     /**
     * author @bardiz12
     * @var Array $searchExcept
     * exclude field to be search on searchWithKeyword() Methods
     */
    protected $searchExcept = [];

    protected $_relationField = [];
    protected $_relationFieldInject = [];

    /**
     * getComboForeign
     * author @bardiz12
     * get paginated List of Combobox for selection based on foreign field id on the declared table
     * @param String $field;
     * @param Array $customConfig;
     */
    public function getComboForeign($field, $customConfig = [])
    {
        $config = [
            "q" => "",
            "count" => 100,
            "foreign_table_field" => null,
            "initial" => null,
        ];

        $config = array_merge($config, $customConfig);
        if ($config['count'] > 100) {
            $config['count'] = 100;
        }
        if ($this->relationField[$field] ?? false) {
            $relation = $this->getRelationField($field);
            if ($relation === null) {
                return null;
            }
            $field_to_search = $config['foreign_table_field'] ?? $relation['join']['inject'];
            $builder = DB::table($relation['join']['table'])
                ->select([
                    DB::raw($relation['join']['field'] . " as `id`"),
                    DB::raw("$field_to_search as text")
                ]);
            
            $builder = $builder->whereNull($relation['join']['table'] . ".deleted_at");
            if($config['initial'] === null){
                if ($config['q'] !== "") {
                    $builder = $builder->where($field_to_search, 'like', '%' . $config['q'] . '%');
                }
                // $builder = $builder->limit($config['count'])->get();
                $builder = $builder->paginate($config['count']);
                return $builder;
            }else{
                return $builder->where($relation['join']['field'],$config['initial'])->first();
            }

        }
        return null;
    }

    /**
     * showWithForeign
     * author @bardiz12
     * get detail of a row by ID and auto select it's relational value based on $relationField and $relationFieldInject props.
     * @param Integer $id
     * @param Closure $queryInterceptor
     * QueryInterceptor used to edit the generated Query
     * */
    public function showWithForeign($id, $selectOnly = null, Closure $queryInterceptor = null)
    {
        if(is_array($id)){
            $builder = $this->where($this->table . "." . $id['field'], $id['value']);
        }else{
            $builder = $this->where($this->table . "." . $this->primaryKey, $id);
        }

        $relations = $this->getRelationField();
        if($selectOnly){
            $builder = $builder->select($this->generateSelectForSearch($selectOnly));
        }else{
            $builder = $builder->select(DB::raw($this->table . ".*"));
        }
        
        foreach ($relations as $relation) {
            $tableToJoin = $relation['join']['table'] . " as " . $relation['join']['alias'];

            $leftSide = $relation['join']['alias'] . "." . $relation['join']['field'];
            $rightSide = $this->table . "." . $relation['field'];

            $builder = $builder->leftJoin($tableToJoin, $leftSide, "=", $rightSide);

            $builder = $builder->addSelect($relation['join']['alias'] . "." . $relation['join']['inject'] . " as " . $relation['field']);
            $builder  = $builder->addSelect($this->table . "." . $relation['field'] . " as raw_" . $relation['field']);
            $fieldTetangga[$relation['field']] = $relation['join']['alias'] . "." . $relation['join']['inject'];
        }

        if($queryInterceptor != null){
            $builder = $queryInterceptor($builder, $this);
        }
        // dd($builder->toSql());
        return $builder->first();
    }

    /**
     * searchWithKeywords
     * author @bardiz12
     * search keywords on defined table fields and it's foreign value based on $relationField and $relationFieldInject props.
     * @param Request|Array $request
     * @param Array $selectOnly
     * @param Closure $modifier
     * @param Closure $queryInterceptor
     * @param Boolean $disablePaginate,
     * @param Boolean $disableSearch
     * QueryInterceptor used to edit the generated Query
     * */

    public function searchWithKeywords(
        $request,
        $selectOnly = null,
        Closure $modifier = null,
        Closure $queryInterceptor = null,
        $disablePaginate = null,
        $disableSearch = null
    ) {
        $selectOnly = $selectOnly ?? [];
        $disablePaginate = $disablePaginate ?? false;
        $disableSearch = $disableSearch ?? false;
        $relations = $this->getRelationField();
        if(is_array($request)){
            $config = [
                'keyword' => $request['keyword'] ?? "",
                'order_by' => [
                    "field" => $request["fieldOrderBy"] ?? "created_at",
                    "mode" => $request["modeOrderBy"] ?? "asc",
                ],
                "per_page" => $request["per_page"] ?? $this->paginationSize,
                "field_filters" => $request['filters'] ?? null
            ];
        }else if($request instanceof Request){
            $config = [
                'keyword' => $request->input('keyword'),
                'order_by' => [
                    "field" => $request->input("fieldOrderBy") ?? "created_at",
                    "mode" => $request->input("modeOrderBy") ?? "asc",
                ],
                "per_page" => $request->input("per_page") ?? $this->paginationSize,
                "field_filters" => $request->input("filters")
            ];
        }else{
            throw new \Exception("First parameter need to be array or Request Object");
        }

        // dd($config);
        if ($config['per_page'] > 100) {
            $config['per_page'] = 100;
        }
        $keyword = $config['keyword'] ?? null;
        $orderBy = $config['order_by'];

        $builder = $this;
        $builder = $this->select($this->generateSelectForSearch($selectOnly,$relations));
        $fieldTetangga = [];

        foreach ($relations as $relation) {

            if (count($selectOnly) > 0 && !in_array($relation["field"], $selectOnly)) {
                continue;
            }
            $tableToJoin = $relation['join']['table'] . " as " . $relation['join']['alias'];

            $leftSide = $relation['join']['alias'] . "." . $relation['join']['field'];
            $rightSide = $this->table . "." . $relation['field'];

            $builder = $builder->leftJoin($tableToJoin, $leftSide, "=", $rightSide);

            $builder = $builder->addSelect($relation['join']['alias'] . "." . $relation['join']['inject'] . " as " . $relation['field']);
            $builder  = $builder->addSelect($this->table . "." . $relation['field'] . " as raw_" . $relation['field']);
            $fieldTetangga[$relation['field']] = $relation['join']['alias'] . "." . $relation['join']['inject'];
        }
        if ($keyword && !$disableSearch) {
            $builder = $builder->where(function ($query) use ($keyword, $fieldTetangga) {
                $excludeSearch = $this->getExcludedSearch();
                foreach ($this->fillable as $field) {
                    if (!in_array($field, $excludeSearch) && !isset($fieldTetangga[$field])) {
                        $query->orWhere($this->table . "." . $field, "like", "%" . $keyword . "%");
                    }
                }

                foreach ($fieldTetangga as $field => $tetanggaField) {
                    $query->orWhere($tetanggaField, "like", "%" . $keyword . "%");
                }
            });
        }

        $builder = $builder->whereNull($this->table . ".deleted_at");

        if ($config["field_filters"] != null) {
            $builder->where(function ($query) use ($config) {
                foreach ($config["field_filters"] as $fieldFilterName => $filtersValue) {
                    if (in_array($fieldFilterName, $this->fillable)) {
                        if(is_array($filtersValue)){
                            $query->whereIn($this->table . "." . $fieldFilterName, $filtersValue);
                        }else if(empty($filtersValue) === false){
                            $query->where($this->table . "." . $fieldFilterName, $filtersValue);
                        }
                    }
                }
            });
        }
        if ($orderBy['field'] == 'created_at' || $orderBy['field'] == 'deleted_at') {
            $toOrderBy = $this->table . "." . $orderBy['field'];
        } else {
            $toOrderBy = $fieldTetangga[$orderBy['field']] ?? (in_array($orderBy['field'], array_merge($this->fillable,[$this->primaryKey])) ? $orderBy['field'] : null);

            if ($toOrderBy == null) {
                throw new \Exception("Column " . $orderBy['field'] . " not found");
            }
        }

        $builder = $builder->orderBy("ss", $orderBy['mode']);
        $builder = $builder->reorder();
        $builder = $builder->orderBy($toOrderBy, $orderBy['mode']);

        if ($queryInterceptor != null) {
            $builder = $queryInterceptor($builder, $config, $this);
        }

        // return $builder->toSql();
        if ($disablePaginate) {
            $result = $builder->get();
        } else {
            $result = $builder->paginate((int) $config['per_page'])->withQueryString();
            // $result = $builder->appends(['search' => 'a']);
        }

        if ($modifier != null) {
            $result->getCollection()->map($modifier);
        }
        return $result;
    }

    /**
     * getExcludedSearch
     */
    private function getExcludedSearch()
    {
        return array_merge(
            ['created_at', 'updated_at', 'deleted_at'],
            $this->searchExcept
        );
    }

    /**
     * getRelationField
     * generate Relationfield by $tableField
     * 
     */
    private function getRelationField($tableField = null)
    {
        $relations = $this->relationField;
        $result = [];
        // dd($relations);
        $key = 0;
        $fieldInjects = $this->relationFieldInject ?? [];
        foreach ($relations as $field => $relation) {
            $explode = explode(".", $relation);
            $fieldInject = $fieldInjects[$field] ?? null;

            $item = [
                "field" => $field,
                "join" => [
                    "table" => $explode[0],
                    "alias" => $field . "_" . $explode[0],
                    "field" => $explode[1],
                    "inject" => $fieldInject
                ]
            ];
            if ($tableField == $field) {
                return $item;
            }
            $result[] = $item;
        }

        return $result;
    }

    private function parseVueFilter($filters)
    {
        try {
            if ($filters) {
                $filtersRaw = explode(";", $filters);
                $res = [];
                foreach ($filtersRaw as $filter) {
                    $exp = explode(":", $filter);
                    $vals = explode(",", $exp[1]);
                    foreach ($vals as $val) {
                        if (!empty($val)) {
                            $res[$exp[0]][] = $val;
                        }
                    }
                }
                return $res;
            }
        } catch (\Exception $e) {
            //pass
        }
        return null;
    }

    public function generateSelectForSearch($fields, $exceptRelation=null)
    {
        $except_field = [];
        if($exceptRelation){
            $except_field = array_map(function($item){
                return $item['field'];
            }, $exceptRelation);
        }
        if (count($fields) > 0) {
            $fields = array_filter($fields, function($item) use($except_field){
                return !in_array($item,$except_field);
            });
            $ar = array_merge(
                array_map(function ($field) {
                    return DB::raw($this->table . "." . $field);
                }, $fields),
                [
                    DB::raw($this->table . ".created_at")
                ],
            );
            
            return $ar;
        }
        $select = [DB::raw($this->table.".".$this->primaryKey)];
        foreach($this->fillable as $field){
            if(!in_array($field,$this->hidden) && !in_array($field,$except_field)){
                $select[] = DB::raw($this->table . "." . $field);
            }
        }
        $select[] = DB::raw($this->table . ".created_at");
        return $select;
    }

    /**
     * getCombo
     * author @bardiz12
     * get paginated List of Combobox for declared table 
     * @param String $field;
     * @param Array $customConfig;
     */
    public function getCombo($field, $customConfig, $queryInterceptor=null)
    {
        $config = [
            "q" => "",
            "count" => 100
        ];

        $config = array_merge($config, $customConfig);
        if ($config['count'] > 100) {
            $config['count'] = 100;
        }

        $builder = $this->select(
            DB::raw($this->primaryKey . " as `value`"),
            DB::raw(is_array($field) ? $field[0] : $field . " as label")
        );
        if($config['q'] != ""){
            if(is_array($field)){
                $builder = $builder->where(function($query) use($field, $config){
                    foreach($field as $item){
                        $query->orWhere($item, "like", "%".$config['q']."%");
                    }
                });
            }else{
                $builder = $builder->where($field,"like", "%".$config['q']."%");
            }
        }

        if($queryInterceptor){
            $builder = $queryInterceptor($builder, $this);
        }
        return $builder->paginate($config['count']);
    }

    public function disableJoin(){
        $this->_relationField = $this->relationField;
        $this->_relationFieldInject = $this->relationFieldInject;
        $this->relationField = [];
        $this->relationFieldInject = [];
    }

    public function enableJoin(){
        $this->relationField = $this->_relationField;
        $this->relationFieldInject = $this->_relationFieldInject;
        $this->_relationField = [];
        $this->_relationFieldInject = [];
    }
}
