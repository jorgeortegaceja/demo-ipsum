<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
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
            $session = $this->setSession($user->hits->hits[0]->_id);
            return response()->json([
                'email' => $user->hits->hits[0]->_source->email,
                'user_name' => $user->hits->hits[0]->_source->user_name,
                'user_id' => $user->hits->hits[0]->_id,
                'acl' => $this->getAccess(),
                'settings' => $user->hits->hits[0]->_source->settings,
                'navigate' => $user->hits->hits[0]->_source->navigate,
                'historic' => $user->hits->hits[0]->_source->historic,
                'session' => $session
            ]);
        }

        return response()->json([
            'message' => 'The given data was invalid.',
            'errors'=> [
                'credentials' => ['Estas credenciales son incorrectas']
            ]
        ], 422);
    }

    private function setSession($user_id){
        $session = [
            'token' => Str::random(90),
            'expires_at' => now()->addHours(8)
        ];
        $url = 'https://elastic:x5tu4F6aXabmLEy5WYiQrlx4@demo-ipsum.es.eastus2.azure.elastic-cloud.com:9243';
        $response =  Http::withHeaders([
                                'Content-Type' => 'application/json',
                    ])
                    ->post("$url/users/_update/$user_id", [
                        "doc" => [
                            "session" =>$session
                        ]
                    ]);
        return $session;
    }

    private function getAccess(){
        return (object)[
            "navigation_drawer"=> [
                (object)[
                    "name" => 'home',
                    "title"=> "Home",
                    "icon"=> "mdi-home"
                ],
                (object)[
                    "name" => 'users',
                    "title"=> "Users",
                    "icon"=> "mdi-account-multiple"
                ],
                (object)[
                    "name" => 'risks',
                    "title"=> "Risks",
                    "icon"=> "mdi-alert-decagram"
                ]
            ],
            "menu"=> [
                (object)[
                    "name" => "Search",
                    "title"=> "Search",
                    "icon"=> "mdi-magnify"
                ],
                (object)[
                    "name" => "my-profile",
                    "title"=> "My profile",
                    "icon"=> "mdi-account-circle"
                ]
            ]
        ];
    }


    public function updateNavigation(Request $request){
        $url = 'https://elastic:x5tu4F6aXabmLEy5WYiQrlx4@demo-ipsum.es.eastus2.azure.elastic-cloud.com:9243';
        $response =  Http::withHeaders([
                                'Content-Type' => 'application/json',
                            ])
                            ->post("$url/users/_update/". session('authenticated')->user_id, [
                                "doc" => [
                                    "navigate" => ['component' => $request->component]
                                ]
                            ]);
        $user = json_decode($response->body());

        $session = session('authenticated');
        $session->navigate->component =  $request->component;
        session('authenticated', $session);
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