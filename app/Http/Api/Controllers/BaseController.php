<?php

namespace App\Http\Api\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

use function response;

class BaseController extends Controller
{
    protected function responseBadRequest(): JsonResponse
    {
        return response()->json(['error' => 'Bad operation'])->setStatusCode(Response::HTTP_BAD_REQUEST);
    }

    protected function responseOk(JsonResource $data): JsonResponse
    {
        return response()->json(['data' => $data])->setStatusCode(Response::HTTP_OK);
    }

    protected function responseCreated(JsonResource $data): JsonResponse
    {
        return response()->json(['data' => $data])->setStatusCode(Response::HTTP_CREATED);
    }

    protected function responseInvalidData(string $message, array $errors): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'errors' => $errors
        ])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    protected function responseMethodNotAllowed(): JsonResponse
    {
        return response()->json(['error' => 'Has Not Implemented'])->setStatusCode(Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
