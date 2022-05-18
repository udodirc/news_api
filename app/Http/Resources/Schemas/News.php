<?php

namespace App\Http\Resources\Schemas;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     required={"user_id", "title", "link", "upvotes"}
 * )
 */

class News extends JsonResource
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

    /**
     * @OA\Property(
     *     format="int64",
     *     example=1
     * )
     */
    public int $upvotes;
}
