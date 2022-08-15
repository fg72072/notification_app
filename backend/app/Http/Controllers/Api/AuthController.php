<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use JWTAuth;
use Validator;
use App\Models\Otp as AppOtp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{
    public $token = true;

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:150',
            'email' => 'required|email|max:150|unique:users',
            'password' => 'required|min:8|max:20|confirmed',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->token) {
            return $this->login($request);
        }
        return response()->json([
            'success' => true,
            'data' => $user
        ], Response::HTTP_OK);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        $input = $request->only('email', 'password');
        $jwt_token = null;
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($user->status == '1') {
            return response()->json([
                'success' => false,
                'message' => 'Your status is not active.',
            ], Response::HTTP_UNAUTHORIZED);
        } else {
            return response()->json([
                'success' => true,
                'token' => $jwt_token,
                'user' => JWTAuth::user()
            ], Response::HTTP_OK);
        }
    }

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ], Response::HTTP_OK);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getUser(Request $request)
    {

        $user = JWTAuth::user();

        return response()->json([
            'success' => true,
            'user' => $user
        ], Response::HTTP_OK);
    }

    public function reset(Request $req)
    {
        $validate = Request()->validate([
            'email' => 'required',
            'otp' => 'required',
        ]);
        $otp = AppOtp::orderBy('id','desc')->whereHas('user',function($q) use($req){
            $q->where('email',$req->email);
        })->where('otp',$req->otp)->where('verify','0')->first();
        $token = '';
        if($otp){
            $validate = Request()->validate([
                'password' => 'required|min:8|confirmed',
            ]);
            $otp->user->password = Hash::make($req->password);
            $otp->user->save();
            if (!$token = JWTAuth::fromUser($otp->user)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email or password',
                ], 401);
            }
            else{
                $otp->verify = '1';
                $otp->save();
                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'user' => $otp->user,
                ],200);
            }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid Otp or Expire',
            ], 401);
        }
    }
}
