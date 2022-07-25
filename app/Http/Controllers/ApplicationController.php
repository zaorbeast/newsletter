<?php

namespace App\Http\Controllers;

use App\Models\application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ApplicationResource;
use Exception;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app=application::paginate(10);
        return ApplicationResource::collection($app);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules=array('Nom_application'=>'required','AppCode'=>'required');
        $validator=Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json( $validator->errors(),400);
        } else {
            try {
                $app=new application();
                $app->Nom_application=$request->Nom_application;
                $app->AppCode=hash( "sha256",$request->AppCode);
                if ($app->save()) {
                    return new ApplicationResource($app);
                }
            } catch (Exception $e) {
                return response()->json($e,400);
            }

        }
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
        //
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
        //
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
