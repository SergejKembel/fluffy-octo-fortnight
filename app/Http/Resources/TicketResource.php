<?php

namespace App\Http\Resources;

use App\Models\Ticket;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
         * @var Ticket
         */
        $ticket = $this->resource;

        return [
            'id' => $ticket->id,
            'barcode' => $ticket->barcode,
            'barcode_link' => $ticket->barcode_link,
            'visitor' => new VisitorResource($this->whenLoaded('visitor')),
            'event' => new EventResource($this->whenLoaded('event')),
            'created_at' => $ticket->created_at,
            'updated_at' => $ticket->updated_at,
        ];
    }
}
