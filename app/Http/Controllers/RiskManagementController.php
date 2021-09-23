<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RiskManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = 'https://elastic:x5tu4F6aXabmLEy5WYiQrlx4@demo-ipsum.es.eastus2.azure.elastic-cloud.com:9243';
        $response = Http::withHeaders([
                                'Content-Type' => 'application/json',
                    ])->get("$url/risks/_search",[
                        "size"=> 100, //default 10
                        "from"=> 0, //default 0
                        "query"=>
                        [
                            "match_all" => []
                        ]
                    ]);

        return response()->json(json_decode($response->body())->hits->hits);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $_request =  Http::withBasicAuth('demo.ipsum', 'Ipsum.2021')
                        ->withHeaders([
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json'
                        ])
                        ->patch(
                            "https://daviviendagrcdemo.service-now.com/api/now/v2/table/sn_risk_risk/$id",
                            $request->_source
                    );

         return response()->json($_request->body());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}