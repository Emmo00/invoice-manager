<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\V1\BulkStoreCustomerRequest;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerResource;
use App\Filters\V1\CustomerFilter;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = CustomerFilter::transform($request);
        $customers = Customer::where($filter);
        if ($request->query('includeInvoices') == "true") {
            $customers = $customers->with('invoices');
        }
        return CustomerResource::collection($customers->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        request()->validate([
            "email" => "unique:customers"
        ]);
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Bulk store customers
     */
    public function bulkStore(BulkStoreCustomerRequest $request)
    {
        $data = array_map(function ($obj) {
            if (isset ($obj['postalCode'])) {
                unset ($obj['postalCode']);
            }
            return $obj;
        }, $request->all());
        Customer::insert($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
