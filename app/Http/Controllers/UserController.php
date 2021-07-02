<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone'=> 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'direction' => 'required|string|max:255',
            'role'=>'required',
            'description'=>'required|string|max:255',
            //campos de la empresa
            'name_business'=>'required|string',
            'type'=>'required',
            //campos del estudiante
            'career'=>'required|string',
            'semester'=>'required|string'
        ]);
        if ($request->role=="ROLE_BUSINESS"){
            $userable = Business::create([
                'name_business' => $request->get('name_business'),
                'type'=>$request->get('type')
            ]);
        }else{
            $userable = Student::create([
                'career' => $request->get('career'),
                'semester'=>$request->get('semester')
            ]);
        }
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = $userable->user()->create([
            'name' => $request->get('name'),
            'last_name'=>$request->get('last_name'),
            'phone'=>$request->get('phone'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'direction'=>$request->get('direction'),
            'role'=>$request->get('role'),
            'description'=>$request->get('description')
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json( new UserResource($user, $token), 201);
    }
    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(new UserResource($user), 200);
    }
    public function index()
    {
        return new UserCollection(User::paginate());
    }
    public function show(User $user)
    {
        return response()->json(new UserCollection($user),200);
    }
    public function store(Request $request){
        $user = User::create($request->all());
        return response()->json($user,201);
    }
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user,200);
    }
    public function delete(User $user)
    {
        $user->delete();
        return response()->json(null,204);
    }
}


