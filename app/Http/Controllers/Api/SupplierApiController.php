<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierApiController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy('name', 'asc')->get();

        return SupplierResource::collection($suppliers);
    }
}
