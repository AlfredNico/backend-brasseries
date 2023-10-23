<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Repositories\StatusRepository;
use App\Http\Responses\ApiSuccessResponse;
use App\Http\Responses\ApiErrorResponse;
use Illuminate\Http\Response;
use App\Http\Requests\status\StoreStatusRequest;
use App\Models\Status;


class StatusController extends Controller
{
    private StatusRepository $sttRepo;
    public function __construct(StatusRepository $sttRepo = null) {
        $this->sttRepo = $sttRepo;
    }

    /**
     * @OA\Get(
     *    path="/status",
     *    operationId="indexStatus",
     *    tags={"CRUD Status"},
     *    summary="Get list of status",
     *    description="Get list of status",
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
                $this->sttRepo->getAll(),
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }

    /**
     * @OA\Post(
     *      path="/status",
     *      operationId="storeStatus",
     *      tags={"CRUD Status"},
     *      summary="Store Status in DB",
     *      description="Store status in DB",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *           required={"name", "type"},
     *            @OA\Property(property="name", type="string", format="string", example=""),
     *            @OA\Property(property="type", type="string", nullable=false, description="status in the store", enum={"M", "AF", "V", "D"}),
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
    public function store(StoreStatusRequest $rq)
    {
        try {
            return new ApiSuccessResponse(
                $this->sttRepo->create($rq),
                Response::HTTP_CREATED,
                'Status created successfully.'
            );
        } catch (Throwable $ex) {
            return new ApiErrorResponse(
                $ex,
                'An error occurred while trying to create the status'
            );
        }
    }

     /**
     * @OA\Get(
     *    path="/status/{ids}",
     *    operationId="showStatus",
     *    tags={"CRUD Status"},
     *    summary="Get Status Detail",
     *    description="Get status Detail",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="ids", in="path", description="Id of status", required=true,
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
    public function show(Status $status)
    {
        try {
            return new ApiSuccessResponse(
                $status,
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }


      /**
     * @OA\Put(
     *     path="/status/{ids}",
     *     operationId="updateStatus",
     *     tags={"CRUD Status"},
     *     summary="Update status in DB",
     *     description="Update status in DB",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="ids", in="path", description="Id of status", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
      *           required={"name", "type"},
     *            @OA\Property(property="name", type="string", format="string", example=""),
     *            @OA\Property(property="type", type="string", nullable=false, description="status in the store", enum={"M", "AF", "V", "D"}),
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
    public function update(StoreStatusRequest $rq, Status $status)
    {
        try {
            return new ApiSuccessResponse(
                $this->sttRepo->update($rq, $status),
                Response::HTTP_ACCEPTED,
                'Status updated successfully.'
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }

      /**
     * @OA\Delete(
     *    path="/status/{ids}",
     *    operationId="destroyStatus",
     *    tags={"CRUD Status"},
     *    summary="Delete Status",
     *    description="Delete status",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="ids", in="path", description="Id of status", required=true,
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
    public function destroy(Status $status)
    {
        try {
            return new ApiSuccessResponse(
                $this->sttRepo->delete($status),
                Response::HTTP_OK,
                'Status deleted successfully.'
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }
}
