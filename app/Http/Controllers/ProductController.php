<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $query = Product::query();
        if (isset($request->search)) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        $data = $query->orderBy('created_at', 'desc')->get();
        return response()->json($data);
    }

    public function show(Request $request, $id)
    {
        $data = Product::findOrFail($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'sometimes|numeric',
            'selling_count' => 'sometimes|numeric',
            'category_id' => 'sometimes|numeric',
        ]);

        $data = Product::create($validated);
        return response()->json($data);
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'stock' => 'sometimes|numeric',
            'selling_count' => 'sometimes|numeric',
            'category_id' => 'sometimes|numeric',
        ]);

        $data = Product::findOrFail($id)->update($validated);
        return response()->json($data);
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if($product->carts()->count() == 0){
            $data = $product->delete();
            return response()->json($data);
        }
        return response()->json(['message' => 'Can not delete, Product included in cart'], Response::HTTP_UNPROCESSABLE_ENTITY);
    
    }
}
