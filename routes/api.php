<?php

use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'v1', "namespace" => "App\Http\Controllers\Api\V1", "middleware" => "auth:sanctum"], function () {
    Route::apiResource('customers', CustomerController::class);
    Route::apiResource('invoices', InvoiceController::class);

    Route::post('customers/bulk', [CustomerController::class, 'bulkStore']);
    Route::post('invoices/bulk', [InvoiceController::class, 'bulkStore']);

});

Route::get('/keys', function (Request $request) {
    $request->validate([
        'name' => ['string'],
        'email' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);
    $email = $request->email;
    $password = $request->password;
    if (!Auth::attempt(['email' => $email, 'password' => $password])) {
        $user = new User();

        $user->name = $request->name ?? "User";
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();

        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            $user = Auth::user();

            $adminToken = $user->createToken('adminToken', ['get', 'create', 'update', 'delete']);
            $userToken = $user->createToken('userToken', ['get', 'create', 'update']);
            $basicToken = $user->createToken('basicToken', ['get']);

            return [
                'tokens' => [
                    'admin' => $adminToken->plainTextToken,
                    'user' => $userToken->plainTextToken,
                    'basic' => $basicToken->plainTextToken,
                ]
            ];
        }

    }
});