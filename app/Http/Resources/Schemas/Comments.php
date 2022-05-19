<?php

namespace App\Http\Resources\Schemas;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     required={"news_id", "user_id", "content"}
 * )
 */

class Comments extends JsonResource
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
