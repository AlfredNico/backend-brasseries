<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\DiagnosticRepository;
use App\Http\Responses\ApiSuccessResponse;
use App\Http\Responses\ApiErrorResponse;
use Illuminate\Http\Response;

class DiagnosticController extends Controller
{
    private DiagnosticRepository $diagRepo;
    public function __construct(DiagnosticRepository $diagRepo = null) {
        $this->diagRepo = $diagRepo;
    }

    /**
     * @OA\Get(
     *    path="/diagnostics",
     *    operationId="indexDiagnostic",
     *    tags={"CRUD Diagnostic"},
     *    summary="Get list of diagnostics",
     *    description="Get list of diagnostics",
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
                $this->diagRepo->getAll(),
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
