<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;


class UserController extends Controller
{
    protected $user;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        try {

            if (!$this->user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found' => 404]);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                
            return response()->json(['token_expired' => $e->getStatusCode()]);
        
        }
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        try {

            $users = $this->user->get(["id", "name", "email", "created_at"])->toArray();

            return $users;

        }
        catch(\Exception $e) {

            return response()->json([
                "status" => false,
                "message" => $e
            ], $e->getCode());
            
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            $messages = [
                'required'  => 'Atributo requerido',
                'unique'    => 'Atributo único',
            ];

            $validator = $this->validate($request, [
                "name" => "required|string",
                "email" => "required|email|unique:users",
                "password" => "required|string|min:6|max:10"
            ], $messages);

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);       


            if ($user->save()) {
            
                return response()->json([
                    "status" => true,
                    "user" => $user,
                    "http_code" => 201
                ]);

            } else {

                return response()->json([
                    "status" => false,
                    "message" => "Ops, user could not be saved."
                ], 500);

            }
        
        }
        catch(\Exception $e) {

            return response()->json([
                "status" => false,
                "http_code" => http_response_code(),
                "message" => $e                
            ]);
            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {

        try {

            return response()->json([
                "status" => true,
                "user" => $user
            ]);

        }
        catch(\Exception $e) {

            return response()->json([
                "status" => false,
                "message" => $e
            ], $e->getCode());
            
        }

    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {


        try {

            $messages = [
                'required'  => 'Atributo requerido',
                'unique'    => 'Atributo único',
            ];

            $this->validate($request, [
                "name" => "required",
                "email" => "required"
            ], $messages);

            $user->name = $request->name;
            $user->email = $request->email;

            if ($user->save()) {

                return response()->json([
                    "status" => true,
                    "user" => $user
                ]);

            } else {

                return response()->json([
                    "status" => false,
                    "message" => "Ops, user could not be updated."
                ], 500);

            }
        
        }
        catch(\Exception $e) {

            return response()->json([
                "status" => false,
                "http_code" => http_response_code(),
                "message" => $e                
            ]);
            
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        try {

            if ($user->delete()) {
                return response()->json([
                    "status" => true,
                    "user" => $user
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Ops, user could not be deleted."
                ]);
            }

        }
        catch(\Exception $e) {

            return response()->json([
                "status" => false,
                "http_code" => http_response_code(),
                "message" => $e                
            ]);
            
        }

    }
}
