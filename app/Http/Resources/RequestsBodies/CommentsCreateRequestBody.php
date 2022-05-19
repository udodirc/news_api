<?php

namespace App\Http\Resources\RequestsBodies;

/**
 * @OA\RequestBody(
 *     request="CommentsCreateRequestBody",
 *     required=true,
 *     description="Comments request body",
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *             ref="#/components/schemas/CommentsCreateRequestBody"
 *         )
 *     )
 * )
 *
 * @OA\Schema(
 *     required={"news_id", "user_id", "content"}
 * )
 */
class CommentsCreateRequestBody
{
    /**
     * @OA\Property(
     *     format="int64",
     *     example=1
     * )
     */
    public int $news_id;

    /**
     * @OA\Property(
     *     format="int64",
     *     example=1
     * )
     */
    public int $user_id;

    /**
     * @OA\Property(
     *     format="string",
     *     example="Text"
     * )
     */
    public string $content;
}
