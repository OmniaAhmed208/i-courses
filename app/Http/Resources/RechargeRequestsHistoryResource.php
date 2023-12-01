<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RechargeRequestsHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'amount' => (double)$this->amount,
            'status' => $this->status,
            'created_at' => $this->created_at->format('d/m/Y'),
            'receipt_image' => asset('storage/' . $this->receipt_image)
        ];
    }
}
