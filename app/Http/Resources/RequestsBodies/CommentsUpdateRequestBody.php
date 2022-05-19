<?php

namespace App\Http\Resources\RequestsBodies;

/**
 * @OA\RequestBody(
 *     request="CommentsUpdateRequestBody",
 *     required=true,
 *     description="Comments request body",
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *             ref="#/components/schemas/CommentsUpdateRequestBody"
 *         )
 *     )
 * )
 *
 * @OA\Schema(
 *     required={"content"}
 * )
 */
class CommentsUpdateRequestBody
{
    /**
     * @OA\Property(
     *     format="string",
     *     example="Text"
     * )
     */
    public string $content;
}
