<?php

namespace App\Http\Resources\Sponsor;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->image->option,
            'file' => $this->file_url,
            'thumbnail' => $this->thumbnail_url,
            'sponsor' => new SponsorResource($this->sponsor),
            'desc' => $this->desc,
            'url' => $this->url,
        ];
    }
}
