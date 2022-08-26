<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\EmaiRessource;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email = email::paginate(10);
        return emaiRessource::collection($email);
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
        $rules = array('email' => 'required', 'Appcode' => 'required');
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } else {
            $appCode = $request->Appcode;
            $app = DB::table('applications')
                ->where('applications.AppCode', hash("sha256", $appCode))
                ->select('applications.id')
                ->get();
            if (!$app->isEmpty()) {
                try {
                    // $AppCode3=hash("sha256",$appCode);
                    $emails = new email();
                    $emails->email = $request->email;
                    $emails->Appcode = hash("sha256", $request->Appcode);
                    if ($emails->save()) {
                        return response()->json(["task" => true]);
                    }
                } catch (Exception $e) {
                    return response()->json('database error', 500);
                }
            } else {
                return response()->json("AppCode error", 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ids = hash('sha256', $id);
        $emails = email::where('emails.Appcode', $ids)->paginate(10);
        return  emaiRessource::collection($emails);
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
