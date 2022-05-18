<?php

namespace App\Http\Resources\Responses;

/**
 * @OA\Schema(
 *     required={"message"}
 * )
 */
class UnauthorizedResponse
{
    /**
     * @var string $message
     * @OA\Property(
     *     type="string",
     *     example="Unthorized"
     * )
     */
    public $message;
}
