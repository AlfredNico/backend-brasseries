<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Repositories\DepartementRepository;
use App\Http\Responses\ApiSuccessResponse;
use App\Http\Responses\ApiErrorResponse;
use Illuminate\Http\Response;
use App\Http\Requests\departement\StoreDepartementRequest;
use App\Models\Departement;


class DepartementController extends Controller
{
    private DepartementRepository $departRepo;
    public function __construct(DepartementRepository $departRepo = null) {
        $this->departRepo = $departRepo;
    }

    /**
     * @OA\Get(
     *    path="/departements",
     *    operationId="indexDepartement",
     *    tags={"CRUD Departement"},
     *    summary="Get list of departement",
     *    description="Get list of departement",
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
                $this->departRepo->getAll(),
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }

    /**
     * @OA\Post(
     *      path="/departements",
     *      operationId="storeDepartement",
     *      tags={"CRUD Departement"},
     *      summary="Store Departement in DB",
     *      description="Store departement in DB",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *           required={"name", "site_id"},
     *            @OA\Property(property="site_id", type="integer", nullable=true),
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
    public function store(StoreDepartementRequest $rq)
    {
        try {
            return new ApiSuccessResponse(
                $this->departRepo->create($rq),
                Response::HTTP_CREATED,
                'Departement created successfully.'
            );
        } catch (\Illuminate\Database\QueryException $e) {
            return new ApiErrorResponse(
                $e,
                'SQLSTATE: Foreign key violation'
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse(
                $th,
                'An error occurred while trying to create the departement.'
            );
        }
    }

     /**
     * @OA\Get(
     *    path="/departements/{ids}",
     *    operationId="showDepartement",
     *    tags={"CRUD Departement"},
     *    summary="Get Departement Detail",
     *    description="Get departement Detail",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="ids", in="path", description="Id of departement", required=true,
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
    public function show(Departement $departement)
    {
        try {
            return new ApiSuccessResponse(
                $departement,
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }


      /**
     * @OA\Put(
     *     path="/departements/{ids}",
     *     operationId="updateDepartement",
     *     tags={"CRUD Departement"},
     *     summary="Update departement in DB",
     *     description="Update departement in DB",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="ids", in="path", description="Id of departement", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *           required={"name", "site_id"},
     *            @OA\Property(property="site_id", type="integer", nullable=true),
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
    public function update(StoreDepartementRequest $rq, Departement $departement)
    {
        try {
            return new ApiSuccessResponse(
                $this->departRepo->update($rq, $departement),
                Response::HTTP_ACCEPTED,
                'Departement updated successfully.'
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }

      /**
     * @OA\Delete(
     *    path="/departements/{ids}",
     *    operationId="destroyDepartement",
     *    tags={"CRUD Departement"},
     *    summary="Delete Departement",
     *    description="Delete departement",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="ids", in="path", description="Id of departement", required=true,
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
    public function destroy(Departement $departement)
    {
        try {
            return new ApiSuccessResponse(
                $this->departRepo->delete($departement),
                Response::HTTP_OK,
                'Departement deleted successfully.'
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }
}
