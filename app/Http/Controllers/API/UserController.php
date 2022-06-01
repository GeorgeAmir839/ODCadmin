<?php

namespace App\Http\Controllers\API;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\StudentCourse;
use App\Notifications\AdminSendCodeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\API\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class UserController extends Controller
{
    use ApiResponseTrait;

    public function login(Request $request)
    {
        // dd("Dd");
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
        if($roles[0]=='student'){
            return $this->apiResponse(null,'Allaw only for admin',404);
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
    }


    public function logout (Request $request)
    {
        $token =$request->user()->token();
        $token->delete();
        $response =["massage"=>"you have success logout "];
        return response($response,200);
    }

    public function register(Request $request)
    {
        // dd($request);
        $rules = array(
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'phone'=>'required|unique:users',
            'password'=>'required|min:8',
            // 'role'=>'required',
            
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return [
                'status' => false,
                'message' => $validator->errors()->first()
            ];
        }
        // dd('f');
        $user = User::create([
            'name' =>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>bcrypt($request->password),

        ]);
        // $user->assignRole(2);
        $token = $user->createToken('API Token')->accessToken;
        return response()->json([
            'status' => (bool) $user,
            'user'   => $user,
            'message' => $user ? 'success register!' : 'an error has occurred',
            'token' => $token
        ], 201);
       
      
    }
    
    // public function registeradmin(Request $request)
    // {

    //     $rules = array(
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6|confirmed',
    //     );
    //     $validator = Validator::make($request->all(), $rules);
    //     if ($validator->fails()) {
    //         return [
    //             'status' => false,
    //             'message' => $validator->errors()->first()
    //         ];
    //     }
    //     $user = User::create([
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'password_confirmation'=>$request->password_confirmation
    //     ]);
    //     $token = $user->createToken('API Token')->accessToken;
    //     return response()->json([
    //         'status' => (bool) $user,
    //         'user'   => $user,
    //         'message' => $user ? 'success register!' : 'an error has occurred',
    //         'token' => $token
    //     ], 201);
    // }
    public function send_code($id)
    {
       $user= User::find($id);
       $user->verification_code = rand(100000, 999999);
       $user->save();
       Notification::send($user, new AdminSendCodeNotification($user->verification_code));
       return $this->apiResponse($user->verification_code,'success',200);
    //    dd($user->studentCourses);
    //    Notification::send($user, new NewBookingAdminNotification($user->course));
    //    dd($user);
    }
}
