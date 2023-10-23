<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Repositories\VehicleRepository;
use App\Http\Responses\ApiSuccessResponse;
use App\Http\Requests\vehicle\StoreVehicleRequest;
use App\Http\Responses\ApiErrorResponse;
use Illuminate\Http\Response;
use App\Models\Vehicle;


class VehicleController extends Controller
{
    private VehicleRepository $vehlRepo;
    public function __construct(VehicleRepository $vehlRepo = null) {
        $this->vehlRepo = $vehlRepo;
    }

    /**
     * @OA\Get(
     *    path="/vehicles",
     *    operationId="indexVehicle",
     *    tags={"CRUD Vehicle"},
     *    summary="Get list of vehicles",
     *    description="Get list of vehicles",
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
                $this->vehlRepo->getAll(),
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }

    /**
     * @OA\Post(
     *      path="/vehicles",
     *      operationId="storeVehicle",
     *      tags={"CRUD Vehicle"},
     *      summary="Store Vehicle in DB",
     *      description="Store vehicles in DB",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *           required={"name", "departement_id", "status_vehicle_id"},
     *            @OA\Property(property="departement_id", type="integer", nullable=true),
     *            @OA\Property(property="status_vehicle_id", type="integer", nullable=true),
     *            @OA\Property(property="name", type="string", format="string", example=""),
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
    public function store(StoreVehicleRequest $rq)
    {
        try {
            return new ApiSuccessResponse(
                $this->vehlRepo->create($rq),
                Response::HTTP_CREATED,
                'Vehicle created successfully.'
            );
        } catch (Throwable $ex) {
            return new ApiErrorResponse(
                $ex,
                'An error occurred while trying to create the vehicles'
            );
        }
    }

     /**
     * @OA\Get(
     *    path="/vehicles/{ids}",
     *    operationId="showVehicle",
     *    tags={"CRUD Vehicle"},
     *    summary="Get Vehicle Detail",
     *    description="Get vehicles Detail",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="ids", in="path", description="Id of vehicles", required=true,
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
    public function show(Vehicle $vehicle)
    {
        try {
            return new ApiSuccessResponse(
                $vehicle,
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }


      /**
     * @OA\Put(
     *     path="/vehicles/{ids}",
     *     operationId="updateVehicle",
     *     tags={"CRUD Vehicle"},
     *     summary="Update vehicles in DB",
     *     description="Update vehicles in DB",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="ids", in="path", description="Id of vehicles", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *           required={"name", "departement_id", "status_vehicle_id"},
     *            @OA\Property(property="departement_id", type="integer", nullable=true),
     *            @OA\Property(property="status_vehicle_id", type="integer", nullable=true),
     *            @OA\Property(property="name", type="string", format="string", example=""),
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
    public function update(StoreVehicleRequest $rq, Vehicle $vehicle)
    {
        try {
            return new ApiSuccessResponse(
                $this->vehlRepo->update($rq, $vehicle),
                Response::HTTP_ACCEPTED,
                'Vehicle updated successfully.'
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }

      /**
     * @OA\Delete(
     *    path="/vehicles/{ids}",
     *    operationId="destroyVehicle",
     *    tags={"CRUD Vehicle"},
     *    summary="Delete Vehicle",
     *    description="Delete vehicles",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="ids", in="path", description="Id of vehicles", required=true,
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
    public function destroy(Vehicle $vehicle)
    {
        try {
            return new ApiSuccessResponse(
                $this->vehlRepo->delete($vehicle),
                Response::HTTP_OK,
                'Vehicle deleted successfully.'
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }
}
