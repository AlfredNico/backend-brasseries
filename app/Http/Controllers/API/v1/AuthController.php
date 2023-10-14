<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Http\Responses\ApiSuccessResponse;
use App\Http\Responses\ApiErrorResponse;
use Illuminate\Http\Response;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\SingInRequest;
use Illuminate\Support\Facades\Auth;
use Validator;


class AuthController extends Controller {

    /**
     * @OA\Post(
     *      path="/sign-up",
     *      operationId="signUp",
     *      tags={"AUTH Account"},
     *      summary="Sign Up user to have new account",
     *      description="Sign up user to have new account",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name","username", "password"},
     *            @OA\Property(property="name", type="string", format="string", example=""),
     *            @OA\Property(property="username", type="string", format="string", example=""),
     *            @OA\Property(property="password", type="string", format="password", example=""),
     *            @OA\Property(property="cle_user", type="string", format="string", example=""),
     *            @OA\Property(property="departement_id", type="string", example=""),
     *            @OA\Property(property="usertype_id", type="string", example=""),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="integer", example="200"),
     *             @OA\Property(property="message",type="string", format="string", example="Success"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
    public function signUp(UserStoreRequest $rq) {
        try {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'passwd' => bcrypt($request->password),
                'is_activated' => isset($request->is_activated) ? $request->is_activated : false,
                'cle_user' => isset($request->cle_user) ? $request->cle_user : null,
                'departement_id' => isset($request->departement_id) ? $request->departement_id : null,
                'usertype_id' => isset($request->usertype_id) ? $request->usertype_id : null,
            ]);
            return new ApiSuccessResponse(
                $user,
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse(
                $th,
                'An error occurred while trying to create the user.'
            );
        }
    }


     /**
     * @OA\Post(
     *      path="/sign-in",
     *      operationId="signIn",
     *      tags={"AUTH Account"},
     *      summary="Sign In user to get Token",
     *      description="Sign in user account",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"username", "password", "remember_me"},
     *            @OA\Property(property="username", type="string", format="string", example="mcdermott.hobart@example.org"),
     *            @OA\Property(property="password", type="string", format="password", example="123456"),
     *            @OA\Property(property="remember_me", type="boolean"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="integer", example="200"),
     *             @OA\Property(property="message",type="string", format="string", example="Success"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
    public function signIn(SingInRequest $rq) {
        try {
            $user = User::where('username', $rq['username'])->first();
            if (!$user || !Hash::check($rq['password'], $user->passwd)) {
                return new ApiSuccessResponse(
                    $res,
                    401,
                    'Incorrect username or password.',
                    false
                );
            }

            $token = $user->createToken(
                $user->name.'_'.Carbon::now(),
                ['*'],
                $rq['remember_me'] == true ? Carbon::now()->addDay(30) : Carbon::now()->addMinute(1)
            )->plainTextToken; /* accessToken */

            $res = [
                'user' => $user,
                'token' => $token
            ];
            return new ApiSuccessResponse(
                $res,
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse(
                $th,
                'An error occurred while trying to login an user.'
            );
        }
    }

    /**
     * @OA\Post(
     *      path="/sign-out",
     *      operationId="signOut",
     *      tags={"AUTH Account"},
     *      summary="Sing out user account",
     *      description="Sing out user account",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"ids"},
     *            @OA\Property(property="ids", type="integer"),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="integer", example="200"),
     *             @OA\Property(property="message",type="string", format="string", example="Success"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     */
    public function signOut(Request $rq) {
        try {
            $validator = Validator::make($rq->all(),[
                'ids' => 'required'
            ]);

            if($validator->fails()){
                return new ApiSuccessResponse(
                    null,
                    Response::HTTP_NOT_FOUND ,
                    'id user is required not found !',
                    false
                );
            }

            $user = User::where('ids', (int)$rq['ids'])->first();
            $user && $user->tokens()->delete();
            return $user ? new ApiSuccessResponse(
                null,
                Response::HTTP_OK,
                'Logout success !'
            ) :  new ApiSuccessResponse(
                null,
                Response::HTTP_NOT_FOUND ,
                'user not found !',
                false
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse(
                $th,
                'An error occurred while trying to logout an user.'
            );
        }
    }

    public function refresh() {
        try {
            $res = [
                'user' => Auth::user(),
                'authorisation' => [
                    'token' => Auth::refresh(),
                    'type' => 'bearer',
                ]
            ];

            return new ApiSuccessResponse(
                $res,
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse(
                $th,
                'An error occurred while trying to refresh token.'
            );
        }
    }
}
