<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
{
    public function index()
    {
        try {
            $supplier = Supplier::with(['state','city'])->get();
            return $this->sendResponse($supplier, 'Supplier retrieved successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function store(SupplierRequest $request)
    {
        try {
            $input = $request->all();
            $supplier = Supplier::create($input);
            return $this->sendResponse($supplier, 'Supplier created successfully.',route('supplier'));
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function show(string $id)
    {
        try {
            $supplier = Supplier::find($id);
            if (empty($supplier)) {
                return $this->sendError('Supplier not found.');
            }
            return $this->sendResponse($supplier, 'Supplier retrieved successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function update(SupplierRequest $request, string $id)
    {
        try {
            $input = $request->all();
            $supplier = Supplier::find($id);
            $supplier->name = $input['name'];
            $supplier->address = $input['address'];
            $supplier->contact_number = $input['contact_number'];
            $supplier->state_id = $input['state_id'];
            $supplier->city_id = $input['city_id'];
            $supplier->save();
            return $this->sendResponse($supplier, 'Supplier updated successfully.',route('supplier'));
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $supplier = Supplier::find($id);
            if (empty($supplier)) {
                return $this->sendError('Supplier not found.');
            }
            $supplier->delete();
            return $this->sendResponse([], 'Supplier deleted successfully.');
        } catch (\Throwable $th) {
            return $this->sendError('Error.', ['error' => $th->getMessage()]);
        }
    }
}
