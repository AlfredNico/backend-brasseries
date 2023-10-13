<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class ApiSuccessResponse implements Responsable {
    /**
     * @param  String  $message
     * @param  mixed  $data
     * @param  int  $code
     */
    public function __construct(
        private String $message,
        private mixed $data,
        private int $code = Response::HTTP_INTERNAL_SERVER_ERROR,
    ) {}

    /**
     * @param  $request
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function toResponse($request) {
        return response()->json([
            'success' => true,
            'message' => $this->message,
            'data' => $this->data,
        ], $this->code);
    }
}
