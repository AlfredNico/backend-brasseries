<?php

namespace App\Http\Responses;

use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Responsable;
use Throwable;

class ApiErrorResponse implements Responsable {

    public function __construct(
        private ?Throwable $exception = null,
        private ?string $message =  'Error',
        private int $code = Response::HTTP_INTERNAL_SERVER_ERROR,
    ) {}

    /**
     * @param  $request
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function toResponse($request) {
        $response = ['message' => $this->message];
        if (! is_null($this->exception) && config('app.debug')) {
            $response = [
                'success'   => false,
                'message' => $this->exception->getMessage(),
                'data'    => [
                    'file'    => $this->exception->getFile(),
                    'line'    => $this->exception->getLine(),
                    // 'trace'   => $this->exception->getTraceAsString()
                ]
            ];
        }
        return response()->json([
            $response
        ], $this->code);
    }
}
