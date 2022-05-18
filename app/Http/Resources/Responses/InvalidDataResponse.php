<?php

namespace App\Http\Resources\Responses;

/**
 * @OA\Schema(
 *     required={"errors", "message"}
 * )
 */
class InvalidDataResponse
{
    /**
     * @var array $errors
     * @OA\Property(
     *     type="array",
     *     @OA\Items(
     *         type="string",
     *         example="any validation error"
     *     )
     * )
     */
    public $errors;

    /**
     * @var string $message
     * @OA\Property(
     *     type="string",
     *     example="any error message"
     * )
     */
    public $message;
}
