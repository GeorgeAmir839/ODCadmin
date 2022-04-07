<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:student');
    // }

    // public function login(Request $request)
    // {
    //     // dd($request);
    //     $data = $request->validate([
    //         'email' => 'email|required',
    //         'password' => 'required'
    //     ]);
    //     $credentials = $request->only('email', 'password');
    //     if(auth()->guard('student')->attempt($credentials)){
    //         return response([
                
    //             'message' => 'you should register first!',
    //         ]);
    //         return response()->json(['success' => $success], $this->successStatus);
    //     }
    //     else{
    //         return response()->json(['error'=>'Email or password incorrect'], 401);
    //     }

    //     if (!auth()->guard('student')->attempt($data)) {
    //         // dd("Dd");
    //         return response([
    //             'status' => (bool)auth()->guard('student'),
    //             'message' => 'you should register first!',
    //         ]);
    //     }
    //     // dd("Dd");
    //     // $token = auth()->user()->createToken('API Token')->accessToken;
    //     return response()->json([
    //         'status' => (bool)auth()->guard('student'),
    //         'user'   => auth()->user(),
    //         'message' => 'success login!' ,
    //         // 'token' => $token
    //     ], 201);
    // }


    public function logout (Request $request)
    {
        Auth::logout();
        return response([
            'status' => 'logout',
            'message' => 'done',
        ]);
    }

    public function register(Request $request)
    {
        // dd("Dd");
        $rules = array(
            'name'=>'required',
            'email'=>'required|email|unique:students',
            'phone'=>'required',
            'password'=>'required|min:8',
            'college'=>'required',
            'address'=>'required',
            
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return [
                'status' => false,
                'message' => $validator->errors()->first()
            ];
        }
        $student = User::create([
            'name' =>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'college'=>$request->college,
            'address'=>$request->address,
            'avtar'=>"dsds",
            'gender'=>"dsds",
            'password'=>bcrypt($request->password),

        ]);
        $student->assignRole(2);
        // $token = $student->createToken('API Token')->accessToken;
        return response()->json([
            'status' => (bool) $student,
            'student'   => $student,
            'message' => $student ? 'success register!' : 'an error has occurred',
            // 'token' => $token
        ], 201);
       
      
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
