<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

class ApiSuccessResponse implements Responsable {
    /**
     * @param  String  $message
     * @param  mixed  $data
     * @param  int  $code
     * @param  bool  $success
     */
    public function __construct(
        private mixed $data,
        private ?int $code = Response::HTTP_INTERNAL_SERVER_ERROR,
        private ?String $message = 'Success',
        private ?bool $success = true,
    ) {}

    /**
     * @param  $request
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function toResponse($request) {
        return response()->json([
            'success' =>  $this->success,
            'message' => $this->message,
            'data' => $this->data,
        ], $this->code);
    }
}
