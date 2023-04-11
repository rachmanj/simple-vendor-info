<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|integer',
            'name' => 'required|string',
            'phone' => 'string',
        ]);

        $branch = Branch::create($request->all());

        return $branch;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_id' => 'required|integer',
            'name' => 'required|string',
            'phone' => 'string',
        ]);

        $branch = Branch::findOrFail($id);
        $branch->update($request->all());

        return $branch;
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return response()->json([
            'message' => 'Branch deleted successfully'
        ]);
    }
}
