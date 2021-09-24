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
                        "size"=> 1000, //default 10
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
          $source = [];
        foreach ($request->_source as $key => $value) {
            if(is_array($value)){
                if(array_key_exists('sys_id', $value) && $value['sys_id']  !== null){
                    $source['u_'.$key] =  $value['sys_id'];
                }
            }else{
                if($value != null)
                 $source['u_'.$key] =  $value;
            }
        }



         $response = Http::withBasicAuth('demo.ipsum', 'Rick.C137')->
            withHeaders([
                'Content-Type' => 'application/json',
            ])->post(
                "https://daviviendagrcdemo.service-now.com/api/now/table/u_imp_tmpl_sn_risk_risk",
                $source

            );
        return response()->json(json_decode($response->body()));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $table, $query)
    {
       $response = Http::withBasicAuth('demo.ipsum', 'Rick.C137')->
            withHeaders([
                'Content-Type' => 'application/json',
            ])->get(
                "https://daviviendagrcdemo.service-now.com/api/now/table/$table?sysparm_query=$query$id&sysparm_limit=10"
            );
        return response()->json(json_decode($response->body()));
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
        $source = [];
        foreach ($request->_source as $key => $value) {
            if(is_array($value)){
                if($value['sys_id']  !== null){
                    $source[$key] =  $value['sys_id'];
                }
            }else{
                 $source[$key] =  $value;
            }
        }

        $_request =  Http::withBasicAuth('demo.ipsum', 'Rick.C137')
                        ->withHeaders([
                            'Accept' => 'application/json',
                            'Content-Type' => 'application/json'
                        ])
                        ->patch(
                            "https://daviviendagrcdemo.service-now.com/api/now/v2/table/sn_risk_risk/$id",
                        $source
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