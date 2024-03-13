<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;

class Filter
{
    protected static array $allowedFields;
    protected static array $columnMap;
    protected static array $operatorMap = [
        "eq" => "=",
        "gt" => ">",
        "lt" => "<",
        "gte" => ">=",
        "lte" => "<=",
        "ne" => "!="
    ];

    public static function transform(Request $request)
    {
        $eloQuery = [];
        $query = $request->query();

        foreach (static::$allowedFields as $field => $operators) {
            if (isset($query[$field])) {
                $queryOperators = $query[$field];
                foreach ($operators as $operator) {
                    if (isset($queryOperators[$operator])) {
                        $eloQuery[] = [static::$columnMap[$field] ?? $field, self::$operatorMap[$operator], $queryOperators[$operator]];
                    }
                }
            }
        }
        return $eloQuery;
    }
}