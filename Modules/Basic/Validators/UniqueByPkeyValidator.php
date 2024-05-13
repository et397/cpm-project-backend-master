<?php
namespace Modules\Basic\Validators;

use Doctrine\DBAL\Schema\Table;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Concerns\ValidatesAttributes;
use Illuminate\Support\Facades\DB;

/**
 * 檢核unique，支援多欄位，適用id table 與 key table
 * example:
 *      table name: example
 *      table pkey: code=> A0, name=>test
 *      unique column: code, name, index
 *      => uniqueByPkey:example,code,name,index,A0,test
 * 和原生比，忽略對ignore column的宣告
 * @param string $tableName
 * @param string $uniqueColumn(第二~n位)
 * @param string $excludeValue(傳入參數總數- pkey的數量)
 */
class UniqueByPkeyValidator
{
    // use ValidatesAttributes;

    // public function __construct(
    //     Translator $translator,
    //     array $data,
    //     array $rules,
    //     array $messages = [],
    //     array $customAttributes = [])
    // {
    //     parent::__construct($translator, $data, $rules, [ 'unique_by_pkey' => '此 :attribute 已存在。'], $customAttributes);
    // }

    // public $messages = ":attibutes 不可重覆。";


    public static function validate($attribute, $value, $parameters, $validator)
    {
        $tableName = $parameters[0];
        $table = static::getTable($tableName);
        $tableColumns = static::getColumns($table);
        $primaryKey = static::getPkey($table);

        $query = static::getQueryBuilderWithoutId($tableName, $primaryKey);

        $columns = array_slice($parameters, 1);

        foreach ($columns as $column) {
            // !in_array($column, $primaryKey) &&
            if (in_array($column, $tableColumns)) {
                $query->where($column, '=',  $validator->getData()[$column]);
            }
        }

        $keyLength = count($primaryKey);
        if (count($parameters) > $keyLength + 1) {
            $excludeId = array_slice($parameters, -$keyLength);
            $index = 0;
            if (!empty($excludeId)) {
                foreach ($primaryKey as $key) {
                    $query->where($key, '<>', $excludeId[$index]);
                    $index = $index + 1;
                }
            }
        }
        // $sql = $query->toSql();
        $count = $query->count();

        return $count === 0;
    }


    protected static function validateObejct()
    {

    }

    protected static function getTable($table): Table
    {
        $table = DB::connection()->getDoctrineSchemaManager()->introspectTable($table);
        return $table;
    }


    protected static function getPkey(Table $table)
    {
        $primaryKey = $table->getPrimaryKey();
        return $primaryKey->getColumns();
    }

    protected static function getColumns(Table $table)
    {
        return array_keys($table->getColumns());
    }

    protected static function getQueryBuilderWithoutId($table, $pkey)
    {
        $grammar = DB::getQueryGrammar();

        $builder = DB::table($table)
            ->select($grammar->wrap('*'));

        foreach ($pkey as $key) {
            $builder = $builder->whereNotNull($key);
        }
        return $builder;
    }
}
