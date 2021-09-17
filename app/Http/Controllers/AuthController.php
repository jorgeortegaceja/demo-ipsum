<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {

        $url = 'https://elastic:x5tu4F6aXabmLEy5WYiQrlx4@demo-ipsum.es.eastus2.azure.elastic-cloud.com:9243';

        $response =  Http::get("$url/users/_search?q=*". $request->email);

        $user = json_decode($response->body());

        if($user->hits->total->value > 0 && Hash::check($request->password, $user->hits->hits[0]->_source->password)){
            $request->session()->put('authenticated', [
                'email' => $user->hits->hits[0]->_source->email,
                'user_name' => $user->hits->hits[0]->_source->user_name,
                'started_at' => now()
            ]);
            return response()->json([]);
        }

        return response()->json([
            'message' => 'The given data was invalid.',
            'errors'=> [
                'credentials' => ['Estas credenciales son incorrectas']
            ]
        ], 422);
    }






    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
    }
}