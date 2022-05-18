<?php

namespace App\Http\Resources\RequestsBodies;

/**
 * @OA\RequestBody(
 *     request="NewsCreateRequestBody",
 *     required=true,
 *     description="News request body",
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(
 *             ref="#/components/schemas/NewsCreateRequestBody"
 *         )
 *     )
 * )
 *
 * @OA\Schema(
 *     required={"user_id", "title", "link"}
 * )
 */
class NewsCreateRequestBody
{
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
     *     example="Title"
     * )
     */
    public string $title;

    /**
     * @OA\Property(
     *     format="string",
     *     example="Link"
     * )
     */
    public string $link;
}
