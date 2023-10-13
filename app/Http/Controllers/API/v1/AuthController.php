<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;


class AuthController extends Controller
{
    public function signUp(Request $rq) {
        $users = User::all();
        return response()->json($users);
    }

    public function signIn(Request $rq) {
        $data = $rq->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('username', $data['username'])->first();
        if (!$user || !Hash::check($data['password'], $user->passwd)) {
            return response([
                'msg' => 'incorrect username or password'
            ], 401);
        }

        // $token = $user->createToken('apiToken')->plainTextToken;
        // $token = $user->createToken('apiToken')->accessToken;
        $token = $user->createToken(
            $user->name.'_'.Carbon::now(),
            ['*'],
            $rq['remember_me'] == true ? Carbon::now()->addDay(30) : Carbon::now()->addMinute(1)
        )->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $token
        ];
        return response()->json($res);
    }

    public function signOut(Request $request) {
        $request->user()->tokens()->delete();
        // $token = $request->user()->token();
        // $token->revoke();

        return response()->json([
            'msg' => 'Successfully logged out'
        ]);
    }

    public function refresh() {
        return response()->json([
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
