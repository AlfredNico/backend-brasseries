<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Repositories\SiteRepository;
use App\Http\Responses\ApiSuccessResponse;
use App\Http\Responses\ApiErrorResponse;
use Illuminate\Http\Response;
use App\Http\Requests\site\StoreSiteRequest;
use App\Models\Site;

class SiteController extends Controller
{
    private SiteRepository $siteRepo;
    public function __construct(SiteRepository $siteRepo = null) {
        $this->siteRepo = $siteRepo;
    }

    /**
     * @OA\Get(
     *    path="/sites",
     *    operationId="indexSite",
     *    tags={"CRUD Site"},
     *    summary="Get list of sites",
     *    description="Get list of sites",
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
                $this->siteRepo->getAll(),
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }


    /**
     * @OA\Post(
     *      path="/sites",
     *      operationId="storeSite",
     *      tags={"CRUD Site"},
     *      summary="Store Site in DB",
     *      description="Store site in DB",
     *      security={{"bearerAuth":{}}},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
      *           required={"name"},
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
    public function store(StoreSiteRequest $rq)
    {
        try {
            return new ApiSuccessResponse(
                $this->siteRepo->create($rq),
                Response::HTTP_CREATED,
                'Site created successfully.'
            );
        } catch (Throwable $ex) {
            return new ApiErrorResponse(
                $ex,
                'An error occurred while trying to create the site'
            );
        }
    }

     /**
     * @OA\Get(
     *    path="/sites/{ids}",
     *    operationId="showSite",
     *    tags={"CRUD Site"},
     *    summary="Get Site Detail",
     *    description="Get site Detail",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="ids", in="path", description="Id of site", required=true,
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
    public function show(Site $site)
    {
        try {
            return new ApiSuccessResponse(
                $site,
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }

    /**
     * @OA\Put(
     *     path="/sites/{ids}",
     *     operationId="updateSite",
     *     tags={"CRUD Site"},
     *     summary="Update site in DB",
     *     description="Update site in DB",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(name="ids", in="path", description="Id of site", required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
      *           required={"name"},
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
    public function update(StoreSiteRequest $rq, Site $site)
    {
        try {
            return new ApiSuccessResponse(
                $this->siteRepo->update($rq, $site),
                Response::HTTP_ACCEPTED,
                'Site updated successfully.'
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }

     /**
     * @OA\Delete(
     *    path="/sites/{ids}",
     *    operationId="destroySite",
     *    tags={"CRUD Site"},
     *    summary="Delete Site",
     *    description="Delete site",
     *    security={{"bearerAuth":{}}},
     *    @OA\Parameter(name="ids", in="path", description="Id of site", required=true,
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
    public function destroy(Site $site)
    {
        try {
            return new ApiSuccessResponse(
                $this->siteRepo->delete($site),
                Response::HTTP_OK,
                'Site deleted successfully.'
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }
}
