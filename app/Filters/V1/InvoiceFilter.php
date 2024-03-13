<?php

namespace App\Filters\V1;

use App\Filters\V1\Filter;

class InvoiceFilter extends Filter
{
    protected static array $allowedFields = [
        "id" => ["eq", "ne"],
        "customerId" => ["eq", "ne"],
        "amount" => ["eq", "ne", "gt", "lt", "gte", "lte"],
        "status" => ["eq", "ne"],
        "billedDate" => ["eq", "ne", "gt", "lt", "gte", "lte"],
        "paidDate" => ["eq", "ne", "gt", "lt", "gte", "lte"],
    ];
    protected static array $columnMap = [
        "customerId" => "customer_id",
        "billedDate" => "billed_date",
        "paidDate" => "paid_date",
    ];
}