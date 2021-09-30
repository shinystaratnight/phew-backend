<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Sponsor\AdResource;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $type = isset($this->sponsor_id) ? 'sponsor' : 'post';
        return [
            'type' => $type,
            'data' => $type == 'post' ? new PostResource($this) : new AdResource($this),
        ];
    }
}
