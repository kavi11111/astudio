<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::all();
        return response()->json($attributes);
    }

    // create new attribute
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:attributes',
            'type' => 'required|string|in:text,date,number,select',
        ]);

        $attribute = Attribute::create($request->only('name', 'type'));
        return response()->json($attribute, 201);
    }

    // get single attribute
    public function show(Attribute $attribute)
    {
        return response()->json($attribute);
    }

    // update attribute
    public function update(Request $request, Attribute $attribute)
    {
        $request->validate([
            'name' => 'sometimes|string|unique:attributes,name,' . $attribute->id,
            'type' => 'sometimes|string|in:text,date,number,select',
        ]);

        $attribute->update($request->only('name', 'type'));
        return response()->json($attribute);
    }

    // delete attribute
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return response()->json(null, 204);
    }
}
