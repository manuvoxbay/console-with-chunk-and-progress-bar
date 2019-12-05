<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
       $validator = Validator::make($request->all(),[
                  'password' => 'required',
                  'email' => 'required',
              ]);
              if($validator->fails())
              {
                  return response() -> json(['error' => $validator->errors()],401);
              }
              if(Auth::attempt(['email' => $request->email,'password' => $request->password]))
              {
                $user = Auth::user();
                $success['token'] = $user->createToken('MyApp')->accessToken;
                return response()->json(['success' => $success],200);
              }
              return response()->json(['error' => "Login failed"],200);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'password' => 'required',
            'email' => 'required',
            'name' => 'required',
        ]);
        if($validator->fails())
        {
            return response() -> json(['error' => $validator->errors()],401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return response() -> json(['success' => $success],200);
    }
}
