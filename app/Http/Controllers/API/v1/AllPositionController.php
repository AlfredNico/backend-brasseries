<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Repositories\AllPositionRepository;
use App\Http\Responses\ApiSuccessResponse;
use App\Http\Responses\ApiErrorResponse;
use Illuminate\Http\Response;
use App\Http\Requests\positions\AllpositionRequest;
use App\Models\AllPositions;


class AllPositionController extends Controller
{
    private AllPositionRepository $allPost;
    public function __construct(AllPositionRepository $allPost = null) {
        $this->allPost = $allPost;
    }

    /**
     * @OA\Get(
     *    path="/all-positions",
     *    operationId="indexAllPositions",
     *    tags={"CRUD AllPositions"},
     *    summary="Get list of all positions",
     *    description="Get list of all positions",
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
    public function index()
    {
        try {
            return new ApiSuccessResponse(
                $this->allPost->getAll(),
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }

    /**
     * @OA\Post(
     *       path="/all-positions",
     *      operationId="storeAllPositions",
     *      tags={"CRUD AllPositions"},
     *      summary="Store AllPositions in DB",
     *      description="Store all positions in DB",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *           required={"last_driver", "vehicle_id", "position_name", "longs", "lats"},
     *            @OA\Property(property="last_driver", type="string", format="string", example=""),
     *            @OA\Property(property="vehicle_id", type="string", format="string", example=""),
     *            @OA\Property(property="position_name", type="string", format="string", example=""),
     *            @OA\Property(property="longs", type="string", format="string", example=""),
     *            @OA\Property(property="lats", type="string", format="string", example=""),
     *            @OA\Property(property="dates", type="string", format="string", example=""),
     *            @OA\Property(property="odometer", type="string", format="string", example=""),
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
    public function store(AllpositionRequest $rq)
    {
        try {
            return new ApiSuccessResponse(
                $this->allPost->create($rq),
                Response::HTTP_CREATED,
                'All positions created successfully.'
            );
        } catch (\Illuminate\Database\QueryException $e) {
            return new ApiErrorResponse(
                $e,
                'SQLSTATE: Foreign key violation'
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse(
                $th,
                'An error occurred while trying to create the all positions'
            );
        }
    }

     /**
     * @OA\Get(
     *    path="/all-positions/{ids}",
     *    operationId="showAllPositions",
     *    tags={"CRUD AllPositions"},
     *    summary="Get AllPositions Detail",
     *    description="Get all positions Detail",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="ids", in="path", description="Id of all positions", required=true,
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
    public function show(AllPositions $allPosition)
    {
        try {
            return new ApiSuccessResponse(
                $allPosition,
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }


      /**
     * @OA\Put(
     *     path="/all-positions/{ids}",
     *     operationId="updateAllPositions",
     *     tags={"CRUD AllPositions"},
     *     summary="Update all positions in DB",
     *     description="Update all positions in DB",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="ids", in="path", description="Id of all positions", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *           required={"last_driver", "vehicle_id", "position_name", "longs", "lats"},
     *            @OA\Property(property="last_driver", type="string", format="string", example=""),
     *            @OA\Property(property="vehicle_id", type="string", format="string", example=""),
     *            @OA\Property(property="position_name", type="string", format="string", example=""),
     *            @OA\Property(property="longs", type="string", format="string", example=""),
     *            @OA\Property(property="lats", type="string", format="string", example=""),
     *            @OA\Property(property="dates", type="string", format="string", example=""),
     *            @OA\Property(property="odometer", type="string", format="string", example=""),
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
    public function update(AllpositionRequest $rq, AllPositions $all_positions)
    {
        try {
            return new ApiSuccessResponse(
                $this->allPost->update($rq, $all_positions),
                Response::HTTP_ACCEPTED,
                'AllPositions updated successfully.'
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }

      /**
     * @OA\Delete(
     *    path="/all-positions/{ids}",
     *    operationId="destroyAllPositions",
     *    tags={"CRUD AllPositions"},
     *    summary="Delete AllPositions",
     *    description="Delete all positions",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="ids", in="path", description="Id of all positions", required=true,
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
    public function destroy(AllPositions $all_positions)
    {
        try {
            return new ApiSuccessResponse(
                $this->allPost->delete($all_positions),
                Response::HTTP_OK,
                'AllPositions deleted successfully.'
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }
}
