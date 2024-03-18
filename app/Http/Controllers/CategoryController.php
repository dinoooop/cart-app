<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();
        if (isset($request->search)) {
            $query->where('name', 'like', "%{$request->search}%");
        }
        $data = $query->orderBy('created_at', 'desc')->get();
        return response()->json($data);
    }

    public function show(Request $request, $id)
    {
        $data = Category::findOrFail($id);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $data = Category::create($validated);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
        ]);

        $data = Category::findOrFail($id)->update($validated);
        return response()->json($data);
    }

    public function destroy(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        if($category->products()->count() == 0){
            $data = $category->delete();
            return response()->json($data);
        }
        return response()->json(['message' => 'Can not delete, Category contains product'], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
