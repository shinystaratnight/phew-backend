<?php

namespace App\Http\Resources\Package;

use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'package_type' => $this->package_type,
            'price' => $this->price,
            'period' => $this->period,
            'period_type' => $this->period_type,
            'plan' => $this->plan,
        ];
    }
}
