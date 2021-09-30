<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Package\PackageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserPackageResource extends JsonResource
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
            'package' => new PackageResource($this->package),
            'package_type' => $this->package_type,
            'subscription_start_date' => $this->subscription_start_date,
            'subscription_end_date' => $this->subscription_end_date,
        ];
    }
}
