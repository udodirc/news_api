<?php

namespace App\Http\Resources\Schemas;

use App\Models\News;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     required={"data"}
 * )
 */
class NewsResponse extends JsonResource
{
    /**
     * @OA\Property(
     *     description="Data wrapper"
     * )
     *
     * @var News
     */
    public $data;
}
