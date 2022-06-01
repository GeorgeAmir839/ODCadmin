<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Notifications\NewBookingAdminNotification;

use Illuminate\Support\Facades\Notification;
use App\Models\StudentCourse;
use App\Http\Controllers\API\ApiResponseTrait;
use App\Models\User;
use App\Notifications\AdminSendCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    use ApiResponseTrait;
    // public function __construct()
    // {
    //     $this->middleware('auth:student');
    // }

    public function login(Request $request)
    {
        // dd($request->email);
        $user=User::where('email',$request->email)->first();
        if($user == null)
        {
            return $this->apiResponse(null,'The User Not Found',404);
        }
        
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
        // dd($user);
        $roles = $user->getRoleNames();
        if($roles[0]!='student'){
            return $this->apiResponse(null,'Allaw only for student',404);
        }
        // dd($roles->);
        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required|without_spaces'
        ]);
        if (!auth()->attempt($data)) {
            return response([
                'status' => (bool)auth()->user(),
                'message' => 'you should register first!',
            ]);
        }
        $token = auth()->user()->createToken('API Token')->accessToken;
        return response()->json([
            'status' => (bool)auth()->user(),
            'user'   => auth()->user(),
            'message' => 'success login!' ,
            'token' => $token
        ], 201);
        // dd($request);
        // $data = $request->validate([
        //     'email' => 'email|required',
        //     'password' => 'required'
        // ]);
        // $credentials = $request->only('email', 'password');
        // if(auth()->guard('student')->attempt($credentials)){
        //     return response([
                
        //         'message' => 'you should register first!',
        //     ]);
        //     return response()->json(['success' => $success], $this->successStatus);
        // }
        // else{
        //     return response()->json(['error'=>'Email or password incorrect'], 401);
        // }

        // if (!auth()->guard('student')->attempt($data)) {
        //     // dd("Dd");
        //     return response([
        //         'status' => (bool)auth()->guard('student'),
        //         'message' => 'you should register first!',
        //     ]);
        // }
        // // dd("Dd");
        // // $token = auth()->user()->createToken('API Token')->accessToken;
        // return response()->json([
        //     'status' => (bool)auth()->guard('student'),
        //     'user'   => auth()->user(),
        //     'message' => 'success login!' ,
        //     // 'token' => $token
        // ], 201);
    }

    public function add_course($id)
    {
    //    dd($id);
        $data = array(
            'student_id'=>5,
            'course_id'=>$id,
            
            
        );
        $user=User::find(5);
        $Course = StudentCourse::create($data);

        if($Course)
        {
            $this->send_notification($user);
            return $this->apiResponse($Course,'The Course added wait until admin send code and go to verify this code to start exam',201);
        }

        return $this->apiResponse(null,'The Course Not Save',400);
    }
    public function send_notification($user)
    {
        // send notification to admin
        $admin = User::find(1);
        // $admins = User::where('user_type', 'admin')->get();
        if (!is_null($admin)) {
            
                // Log::debug("sending email to admins");
                Notification::send($admin, new NewBookingAdminNotification($user));
            
        }

        

    }
    public function start_exam()
    {
        // send notification to admin
        dd(auth()->user()->courses);
        $admin = User::find(1);
        // $admins = User::where('user_type', 'admin')->get();
        if (!is_null($admin)) {
            
                // Log::debug("sending email to admins");
                Notification::send($admin, new AdminSendCodeNotification($user));
            
        }

    }
    public function verify_code(Request $request)
    {
        // dd($request);
        $rules = array(
            'code' => 'required',
            
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return [
                'status' => false,
                'message' => $validator->errors()->first()
            ];
        }
        $user = auth()->user();
        if($user->verification_code == null)
        {
            return $this->apiResponse($user ,'code not send please wait until admin sent to you',201);
        }
        if($user->verification_code == $request->code)
        {
            $user->verification_code = null;
            $user->verified = 1;
            $user->save();

        }else{
            return $this->apiResponse(['invalid code'] ,'invalid code',201);

        }
        $code = $request->code;
        

        

    }
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
        // Validator::extend('without_spaces', function($attr, $request->password){
        //     return preg_match('/^\S*$/u', $value);
        // });
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
        $student->assignRole(4);
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
