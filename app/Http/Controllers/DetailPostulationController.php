<?php

namespace App\Http\Controllers;

use App\Http\Resources\DetailPostulation;
use App\Http\Resources\DetailPostulationCollection;
use App\Http\Resources\DetailPostulation as PostulationResource;
use Illuminate\Http\Request;
use App\Models\DetailsPostulation;

class DetailPostulationController extends Controller
{
    private static $messages = [
        'required'=>'El campo :attribute es obligatorio',
        'exists'=>'El parámetro :attribute no corresponde a ningun registro',
        'integer'=>'El parámetro ingresado en :attribute no es un entero',
        'numeric'=>'El parámetro ingresado en :attribute no es un número',
    ];
    public function index(Request $request)
    {
        return response()->json(new DetailPostulationCollection($request->detail), 200);
    }
    public function show (DetailPostulation $detail)
    {

        return response()->json(new DetailPostulation ($detail), 200);
    }
    public function store(Request $request, Postulation $arequest)
    {
        $request->validate([
            //'request_id' => 'required|exists:requests,id',
            'publication_id' => 'required|exists:publications,id',

        ], self::$messages);
        $detail = $arequest->detail()->save(new DetailPostulation($request->all()));
        return response()->json(new PostulationResource($detail), 201);
    }
    public function update(Request $request, DetailPostulation $detail)
    {
        /* $detail->update($request->all());
         return response()->json($detail, 200); */
    }
    public function delete(DetailPostulation $detail)
    {
        /*$detail->delete();
        return response()->json(null, 204);*/
    }
}
