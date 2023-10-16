<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;
use App\Http\Responses\ApiSuccessResponse;
use App\Http\Responses\ApiErrorResponse;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Repositories\UserRepository;

class UserController extends Controller
{

    private UserRepository $suerRepo;
    public function __construct(UserRepository $suerRepo = null) {
        $this->suerRepo = $suerRepo;
    }

    /**
     * @OA\Get(
     *    path="/users",
     *    operationId="index",
     *    tags={"CRUD User"},
     *    summary="Get list of users",
     *    description="Get list of users",
     *    security={{"bearerAuth":{}}},
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
    public function index()  {
        try {
            return new ApiSuccessResponse(
                $this->suerRepo->getAll(),
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }


      /**
     * @OA\Post(
     *      path="/users",
     *      operationId="store",
     *      tags={"CRUD User"},
     *      summary="Store User in DB",
     *      description="Store user in DB",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
      *           required={"name","username", "password"},
     *            @OA\Property(property="name", type="string", format="string", example=""),
     *            @OA\Property(property="username", type="string", format="string", example=""),
     *            @OA\Property(property="password", type="string", format="password", example=""),
     *            @OA\Property(property="cle_user", type="string", format="string", example=""),
     *            @OA\Property(property="departement_id", type="string", example=""),
     *            @OA\Property(property="usertype_id", type="string", example=""),
     *         ),
     *    ),
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
    public function store(UserStoreRequest $rq) {
        try {
            return new ApiSuccessResponse(
                $this->suerRepo->create($rq),
                Response::HTTP_CREATED
            );
        } catch (Throwable $ex) {
            return new ApiErrorResponse(
                $ex,
                'An error occurred while trying to create the user'
            );
        }
    }


    /**
     * @OA\Get(
     *    path="/articles/{ids}",
     *    operationId="show",
     *    tags={"CRUD User"},
     *    summary="Get User Detail",
     *    description="Get user Detail",
     *    @OA\Parameter(name="ids", in="path", description="Id of user", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="success", type="integer", example="200"),
     *             @OA\Property(property="message",type="string", format="string", example="Success"),
     *             @OA\Property(property="data",type="object")
     *          )
     *        )
     *       )
     *  )
     */
    public function show(User $user)
    {
        try {
            return new ApiSuccessResponse(
                $user,
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }

    /**
     * @OA\Put(
     *     path="/users/{ids}",
     *     operationId="update",
     *     tags={"CRUD User"},
     *     summary="Update user in DB",
     *     description="Update user in DB",
     *     @OA\Parameter(name="ids", in="path", description="Id of user", required=true,
     *         @OA\Schema(type="integer")
     *     ),
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
    public function update(Request $request, User $user)
    {
        try {
            return new ApiSuccessResponse(
                $user,
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }

    /**
     * @OA\Delete(
     *    path="/users/{ids}",
     *    operationId="destroy",
     *    tags={"CRUD User"},
     *    summary="Delete User",
     *    description="Delete user",
     *    @OA\Parameter(name="ids", in="path", description="Id of user", required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *         response=200,
     *         description="Success",
    *          @OA\JsonContent(
     *             @OA\Property(property="success", type="integer", example="200"),
     *             @OA\Property(property="message",type="string", format="string", example="Success"),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *      )
     *  )
     */
    public function destroy(User $user)
    {
        try {
            return new ApiSuccessResponse(
                $user,
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }
}
