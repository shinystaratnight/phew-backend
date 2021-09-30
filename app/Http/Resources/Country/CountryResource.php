<?php

namespace App\Http\Resources\Country;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'name' => $this->name,
            'short_name' => $this->short_name,
            'flag' => $this->flag_url,
            'show_phonecode' => $this->show_phonecode,
            'phonecode' => $this->phonecode,
            'continent' => $this->continent,
        ];
    }
}
