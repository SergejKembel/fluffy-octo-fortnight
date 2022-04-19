<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $city = $this->resource;

        return [
            'id' => $city->id,
            'zip_code' => $city->zip_code,
            'city' => $city->city,
            'created_at' => $city->created_at,
            'updated_at' => $city->updated_at,
        ];
    }
}
