<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        try {
            $customer = Customer::with(['state','city'])->get();
            return $this->sendResponse($customer, 'Customer retrieved successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function store(CustomerRequest $request)
    {
        try {
            $input = $request->all();
            $customer = Customer::create($input);
            return $this->sendResponse($customer, 'Customer created successfully.', route('customer'));
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        try {
            $customer = Customer::find($id);
            if (empty($customer)) {
                return $this->sendError('Customer not found.');
            }
            return $this->sendResponse($customer, 'Customer retrieved successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function update(CustomerRequest $request, string $id)
    {
        try {
            $input = $request->all();
            $customer = Customer::find($id);
            $customer->name = $input['name'];
            $customer->address = $input['address'];
            $customer->contact_number = $input['contact_number'];
            $customer->state_id = $input['state_id'];
            $customer->city_id = $input['city_id'];
            $customer->save();
            return $this->sendResponse($customer, 'Customer updated successfully.', route('customer'));
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $customer = Customer::find($id);
            if (empty($customer)) {
                return $this->sendError('Customer not found.');
            }
            $customer->delete();
            return $this->sendResponse([], 'Customer deleted successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }
}
