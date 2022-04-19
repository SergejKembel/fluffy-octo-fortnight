<?php

namespace App\Http\Resources;

use App\Models\Visitor;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /**
         * @var Visitor
         */
        $visitor = $this->resource;
        return [
            'id' => $visitor->id,
            'firstname' => $visitor->firstname,
            'lastname' => $visitor->lastname,
            'created_at' => $visitor->created_at,
            'updated_at' => $visitor->updated_at
        ];
    }
}
