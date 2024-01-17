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
use App\Http\Requests\user\StoreUserRequest;
use App\Http\Requests\user\FogrotPasswdRequest;
use App\Http\Requests\user\SingInRequest;
use App\Http\Requests\user\ResetPasswdRequest;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Repositories\UserRepository;
use Illuminate\Support\Str;
use Mail;
use App\Mail\SampleMail;


class AuthController extends Controller {

    private UserRepository $userRepo;
    public function __construct(UserRepository $userRepo = null) {
        $this->userRepo = $userRepo;
    }

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
    public function signUp(StoreUserRequest $rq) {
        try {
            return new ApiSuccessResponse(
                $this->userRepo->create($rq),
                Response::HTTP_CREATED
            );
        } catch (\Illuminate\Database\QueryException $e) {
            return new ApiErrorResponse(
                $e,
                'SQLSTATE: Foreign key violation'
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
     *            @OA\Property(property="username", type="string", format="string", example=""),
     *            @OA\Property(property="password", type="string", format="password", example=""),
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
                    null,
                    Response::HTTP_UNAUTHORIZED,
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
            $validator = Validator::make($rq->all(), [
                'ids' => 'required'
            ]);

            if($validator->fails()){
                return new ApiSuccessResponse(
                    null,
                    Response::HTTP_NOT_FOUND,
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
                Response::HTTP_NOT_FOUND,
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


    /**
     * @OA\Post(
     *      path="/reset-pass",
     *      operationId="resetPasswd",
     *      tags={"AUTH Account"},
     *      summary="Reset user password",
     *      description="Reset user password",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"username", "password", "remember_me"},
     *            @OA\Property(property="username", type="string", format="string", example=""),
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
    public function resetPasswd(ResetPasswdRequest $rq)
    {
        try {
            $user = User::where('username', $rq['username'])->first();
            if (!$user) {
                return new ApiSuccessResponse(
                    null,
                    Response::HTTP_NOT_FOUND,
                    'Username not found.',
                    false
                );
            }

            $userToken = Str::random(35);
            $user['expires_at_token'] = Carbon::now()->addHours(3);
            $user['remember_token'] = $userToken;
            $user->save();

            $content = [
                'usrToken' => $userToken
            ];

            Mail::to($rq['username'])->send(new SampleMail($content)); /** SEND MAIL TO RESET USER PASS */

            return new ApiSuccessResponse(
                ['rememner_tkn' => $user['remember_token']],
                Response::HTTP_OK,
            );

        }  catch (\Throwable $th) {
            return new ApiErrorResponse(
                $th,
                'An error occurred while trying to logout an user.'
            );
        }
    }


       /**
     * @OA\Post(
     *      path="/forgot-pass",
     *      operationId="forgotPasswd",
     *      tags={"AUTH Account"},
     *      summary="forgot user passwrod",
     *      description="forgot user passwrod",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"remember_token", "password", "c_password"},
     *            @OA\Property(property="username", type="string", format="password", example=""),
     *            @OA\Property(property="c_password", type="string", format="password", example=""),
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
    public function forgotPasswd(FogrotPasswdRequest $rq)
    {
        try {
            $user = User::where('remember_token', $rq['remember_tkn'])->first();
            if (!$user) {
                return new ApiSuccessResponse(
                    null,
                    Response::HTTP_NOT_FOUND,
                    'User token not found.',
                    false
                );
            }

            /** ->subHours(3)   expires_at_token   */
            $user = User::where('remember_token', $rq['remember_tkn'])
                        ->whereDay('created_at', '>=', date('d'))
                        ->whereMonth('created_at', '>=', date('m'))
                        ->whereYear('created_at', '>=', date('Y'))
                        ->whereTime('created_at', '>=', date('H:m:s'))->first();
                        // ->whereDate('created_at', '>=', Carbon::now()->subHours(3) )->first();
            // $user = User::where('remember_token', $rq['remember_tkn'])->whereRaw("expires_at_token > STR_TO_DATE(?, '%Y-%m-%d %H:%i:%s')", Carbon::now())->first();
            if (!$user) {
                return new ApiSuccessResponse(
                    null,
                    Response::HTTP_NOT_FOUND,
                    'User token is expired, please try again.',
                    false
                );
            }
            $user['expires_at_token'] = null;
            $user['remember_token'] = null;
            $user['passwd'] = bcrypt($rq['passwd']);
            $user->save();
            return new ApiSuccessResponse(
                $user,
                Response::HTTP_OK,
                'User password reset successfully.',
                false
            );
        }  catch (\Throwable $th) {
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
