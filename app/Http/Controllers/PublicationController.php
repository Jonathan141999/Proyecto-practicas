<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Http\Resources\Publication as PublicationResource;
use App\Http\Resources\PublicationCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PublicationController extends Controller
{
    public function index()
    {
        return new PublicationCollection(Publication::paginate());
    }
    public function show(Publication $publication)
    {
        return response()->json(new PublicationCollection($publication),200);
    }
    public function store(Request $request)
    {
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
        ];

        $request->validate([
            'affair' => 'required|string|unique:publications|max:255',
            'details' => 'required|string|max:255',
            'hour' => 'required|string',
            'location' => 'required|string',
            'phone' => 'required|string',
            'date' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ],$messages);
        $publication = Publication::create($request->all());
        return response()->json($publication, 201);
    }
    public function update(Request $request,  Publication $publication)
    {
        $publication->update($request->all());
        return response()->json($publication, 200);
    }
    public function delete(Request $request, Publication $publication )
    {
        $publication->delete();
        return response()->json(null, 204);
    }

}
