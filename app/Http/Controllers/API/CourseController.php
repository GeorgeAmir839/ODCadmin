<?php


namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Controllers\Api\ApiResponseTrait;

class CourseController extends Controller
{
    use ApiResponseTrait;

    
    public function index()
    {
        $categories = Course::with('category')->get();
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
        $Course = Course::with('category')->find($id);
        
        if($Course)
        {
            return $this->apiResponse($Course,'success',200);
        }

        return $this->apiResponse(null,'The Course Not Found',404);
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
            'name' => 'required|max:255',
            'level' => 'required|max:255',
            'category_id'=> 'required',
        ]);

        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $Course = Course::create($request->all());

        if($Course)
        {
            return $this->apiResponse($Course,'The Course Saved',201);
        }

        return $this->apiResponse(null,'The Course Not Save',400);
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
            'level' => 'required|max:255',
            'category_id' => 'required',
        ]);

        if ($validator->fails())
        {
            return $this->apiResponse(null,$validator->errors(),400);
        }

        $Course = Course::find($id);

        if(!$Course)
        {
            return $this->apiResponse(null,'The Course Not Found',404);
        }

        $Course->update($request->all());

        if($Course)
        {
            return $this->apiResponse($Course,'The Course Update',201);
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
        $Course = Course::find($id);

        if(!$Course)
        {
            return $this->apiResponse(null,'The Course Not Found',404);
        }

        $Course->delete($id);

        if($Course)
        {
            return $this->apiResponse(null,'The Course Deleted',200);
        }
    }
}
