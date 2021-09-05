<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Validator;

class CustomerController extends Controller
{
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:customers',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $customer = Customer::create(
                    $validator->validated(),
                );

        return response()->json([
            'message' => 'Customer successfully registered',
            'user' => $customer
        ], 201);
    }
}
