<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Http\Resources\Publication as PublicationResource;
use App\Http\Resources\PublicationCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    private static $messages = [
        'required'=>'El campo :attribute es obligatorio',
        'exists'=>'El parámetro :attribute no corresponde a ningun registro',
        'integer'=>'El parámetro ingresado en :attribute no es un entero',
        'numeric'=>'El parámetro ingresado en :attribute no es un número',
        'string'=>'El campo :attribute tiene que ser un string',
        'image'=>'El campo :attribute no es una imagen',
    ];
    public function index()
    {
        return new PublicationCollection(Publication::paginate(5));
    }
    public function show(Publication $publication)
    {
        return response()->json(new PublicationResource($publication),200);
    }
    public function searchProduct($name)
    {
        $products = Publication::search("%$name*%")->get();
        return response()->json(new PublicationCollection($products), 200);
    }
    public function image(Publication $publication)
    {
        return response()->download(public_path(Storage::url($publication->image)),
            $publication->name);
    }
    public function store(Request $request)
    {
        $this->authorize('create', Publication::class);
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'hour' => 'required|string',
            'type' => 'required|string',
            'details' => 'required|string',
            'image' => 'required|image',
            'category_id' => 'required|exists:categories,id',
        ],self::$messages);
        //$publication = Publication::create($request->all());
        $publication = new Publication($request->all());
        $path = $request->image->store('public/publications');
        $publication->image = 'publications/' . basename($path);
        $publication->setAttribute('name', $request->get('name'));
        //$publication->image = $path;
        $publication->save();
        return response()->json(new PublicationResource($publication), 201);
    }
    public function update(Request $request,  Publication $publication)
    {
        $this->authorize('update',$publication);
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'phone' => 'required|string',
            'hour' => 'required|string',
            'details' => 'required|string',
        ],self::$messages);
        $publication->update($request->all());
        return response()->json($publication, 200);
    }
    public function delete(Request $request, Publication $publication )
    {
        $publication->delete();
        return response()->json(null, 204);
    }

}
