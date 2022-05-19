<?php

namespace App\Http\Resources\Schemas;

use App\Models\Comments;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     required={"data"}
 * )
 */
class CommentsResponse extends JsonResource
{
    /**
     * @OA\Property(
     *     description="Data wrapper"
     * )
     *
     * @var Comments
     */
    public $data;
}
