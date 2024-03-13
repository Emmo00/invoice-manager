<?php

namespace App\Filters\V1;

use App\Filters\V1\Filter;

class CustomerFilter extends Filter
{
    protected static array $allowedFields = [
        "id" => ["eq", "ne"],
        "name" => ["eq", "ne"],
        "type" => ["eq", "ne"],
        "email" => ["eq", "ne"],
        "address" => ["eq", "ne"],
        "city" => ["eq", "ne"],
        "state" => ["eq", "ne"],
        "postalCode" => ["eq", "ne"],
        "country" => ["eq", "ne"],
    ];
    protected static array $columnMap = [
        "postalCode" => "postal_code",
    ];
}