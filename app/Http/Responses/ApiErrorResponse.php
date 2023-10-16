<?php

namespace App\Http\Responses;

use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Throwable;

class ApiErrorResponse implements Responsable {

    // private ?Throwable $exception = null,
    public function __construct(
        private mixed $exception = null,
        private ?string $message =  'Error',
        private int $code = Response::HTTP_INTERNAL_SERVER_ERROR,
    ) {}

    /**
     * @param  $request
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function toResponse($request): JsonResponse {
        $response = ['message' => $this->message];

        if ($this->exception instanceof Throwable) {
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
        } else if ($this->exception instanceof QueryException) {
            $response = [
                'success'   => false,
                'message' => $this->exception->errorInfo,
                'data'    => null
            ];
        } else if ($this->exception instanceof ErrorException) {
            $response = [
                'success'   => false,
                'message' => $this->exception,
                'data'    => null
            ];
        }


        return response()->json([
            $response
        ], $this->code);
    }
}
