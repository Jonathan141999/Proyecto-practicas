<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryCollection as CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private static $messages = [
        'required'=>'El campo :attribute es obligatorio',
        'string'=>'El campo :attribute tiene que ser un string',
    ];
    public function index()
    {
        return new CategoryCollection(Category::all());

    }
    public function show(Category $category)
    {
        $this->authorize('view', $category);
        return response()->json(new CategoryResource($category), 200);

    }
    public function store(Request $request)
    {
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }
    public function update(Request $request,  Category $category)
    {
        $category->update($request->all());
        return response()->json($category, 200);
    }
    public function delete(Request $request, Category $category )
    {
        $category->delete();
        return response()->json(null, 204);
    }

}
