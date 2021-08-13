<?php

namespace App\Http\Controllers;

//use App\Models\Postulation;
use Illuminate\Http\Request;
use App\Models\Postulation as aPostulation;
use App\Http\Resources\Postulation as PostulationResource ;
use App\Http\Resources\PostulationCollection;
use Illuminate\Support\Facades\Auth;
use JWTAuth;


class PostulationController extends Controller
{
    private static $messages = [
        'required'=>'El campo :attribute es obligatorio',
        'numeric'=>'El parámetro ingresado en :attribute no es un número',
        'date' => 'El campo :attribute no es una fecha',
        'status'=> 'El campo :attribute no es una cadena',
    ];
    public function index()
    {
        return new PostulationCollection(aPostulation::all());
        //return Postulation::all();
    }
    public function show(aPostulation $apostulation)
    {
        $this->authorize('view', $apostulation);
        return response()->json(new PostulationResource($apostulation), 200);
    }

    public function requestsByUser()
    {
        $user=Auth::user();
        $requests = $user->postulation;
        return response()->json($requests, 200);
    }

    public function store(Request $request)
    {
        $this->authorize('create', aPostulation::class);
        $request->validate([
            'language' => 'required|string',
            'work_experience' => 'required|string',
            'career' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ], self::$messages);
        $request1 = new aPostulation($request->all());
        $request1->save();
        return response()->json(new PostulationResource($request1), 201);
    }
    public function update(Request $request,  aPostulation $apostulation)
    {
        $this->authorize('update', $apostulation);
        $request->validate([
            'language' => 'required|string',
            'work_experience' => 'required|string',
            'career' => 'required|string',
        ], self::$messages);
        $apostulation->update($request->all());
        return response()->json($apostulation, 200);
    }

    public function updatestatus (Request $request, aPostulation $apostulation){
        //$this->autorize('update', $apostulation);
        $request->validate([
            'status' => 'required|string'
        ], self::$messages);
        $apostulation->update($request->all());
        return response()->json($apostulation, 200);
    }

    public function delete(Request $request, Postulation $postulation )
    {
        $postulation->delete();
        return response()->json(null, 204);
    }

    public function download(){
        $data = [
            'titulo'=> 'Styde.net'
        ];

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('vista-pdf', $data);
        return $pdf->stream('archivo.pdf');
    }
}
