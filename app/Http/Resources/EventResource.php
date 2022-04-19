<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $event = $this->resource;

        return [
            'id' => $event->id,
            'city' => new CityResource($event->city),
            'title' => $event->title,
            'date' => $event->date,
            'created_at' => $event->created_at,
            'updated_at' => $event->updated_at,
        ];
    }
}
