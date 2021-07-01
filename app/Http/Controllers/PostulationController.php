<?php

namespace App\Http\Controllers;

use App\Models\Postulation;
use Illuminate\Http\Request;

class PostulationController extends Controller
{
    public function index()
    {
        return Postulation::all();
    }
    public function show(Postulation $postulation)
    {
        return $postulation;
    }
    public function store(Request $request)
    {
        $postulation = Publication::create($request->all());
        return response()->json($postulation, 201);
    }
    public function update(Request $request,  Postulation $postulation)
    {
        $postulation->update($request->all());
        return response()->json($postulation, 200);
    }
    public function delete(Request $request, Postulation $postulation )
    {
        $postulation->delete();
        return response()->json(null, 204);
    }
}
