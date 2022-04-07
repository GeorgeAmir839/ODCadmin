<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Enroll;
use Illuminate\Http\Request;
use App\Models\studentcourc;

use App\Http\Controllers\Api\ApiResponseTrait;

class EnrollController extends Controller
{
    use ApiResponseTrait;

    
    public function index()
    {
        $categories = Enroll::with('course','student')->get();
        return $this->apiResponse($categories,'success',200);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Enroll = Enroll::with('course','student')->find($id);
        
        if($Enroll)
        {
            return $this->apiResponse($Enroll,'success',200);
        }

        return $this->apiResponse(null,'The Enroll Not Found',404);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator  = Validator::make($request->all(),
        [
            'Enroll_name' => 'required|max:255',
        ]);

        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $Enroll = Enroll::create($request->all());

        if($Enroll)
        {
            return $this->apiResponse($Enroll,'The Enroll Saved',201);
        }

        return $this->apiResponse(null,'The Enroll Not Save',400);
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
        $validator  = Validator::make($request->all(),
        [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $Enroll = Enroll::find($id);

        if(!$Enroll)
        {
            return $this->apiResponse(null,'The Enroll Not Found',404);
        }

        $Enroll->update($request->all());

        if($Enroll)
        {
            return $this->apiResponse($Enroll,'The Enroll Update',201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Enroll = Enroll::find($id);

        if(!$Enroll)
        {
            return $this->apiResponse(null,'The Enroll Not Found',404);
        }

        $Enroll->delete($id);

        if($Enroll)
        {
            return $this->apiResponse(null,'The Enroll Deleted',200);
        }
    } 
}
