<?php

namespace App\Http\Resources\Country;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'country_id' => $this->country_id,
            'country_name' => $this->country->name,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'name' => $this->name,
        ];

        if (isset($this->likes_count)) {
            $like_type = \App\Models\LikePost::whereHas('post', function ($query) {
                $query->where('city_id', $this->id);
            })->select('type', \DB::raw('count(type) as total'))
                ->groupBy('type')
                ->latest('total')
                ->first();
            $data = $data + [
                    'like_count' => $this->likes_count,
                    'like_type' => $like_type->type,
                    'like_type_count' => $like_type->total,
                ];
        }

        return $data;
    }
}
