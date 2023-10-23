<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;


class ApiSuccessResponse implements Responsable {
    /**
     * @param  String  $message
     * @param  mixed  $data
     * @param  int  $code
     * @param  bool  $success
     */
    public function __construct(
        private mixed $data = null,
        private ?int $code = Response::HTTP_INTERNAL_SERVER_ERROR,
        private ?String $message = 'Success',
        private ?bool $success = true,
    ) {}

    /**
     * @param  $request
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function toResponse($request): JsonResponse {
        return response()->json([
            'success' =>  $this->success,
            'message' => $this->message,
            'data' => $this->data,
        ], $this->code);
    }
}
