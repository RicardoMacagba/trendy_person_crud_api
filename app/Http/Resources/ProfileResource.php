<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // public function toArray(Request $request): array
    // {
    //     return parent::toArray($request);
    // }

    public function toArray($request)
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'age' => $this->age,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            

            // Add tradie-specific fields conditionally
            //'trade_type' => $this->when($this->user->role, $this->trade_type),
            // 'trade_type' => $this->when($this->user->role === 'tradie', $this->trade_type),
            // 'hourly_rate' => $this->when($this->user->role === 'tradie', $this->hourly_rate),
            // 'company_name' => $this->when($this->user->role === 'tradie', $this->company_name),

            // 'trade_type' => $this->when($this->user->role === 'homeowner', $this->trade_type),
            // 'hourly_rate' => $this->when($this->user->role === 'homeowner', $this->hourly_rate),
            // 'company_name' => $this->when($this->user->role === 'homeowner', $this->company_name),

            // 'trade_type' => $this->when($this->user->role === 'admin', $this->trade_type),
            // 'hourly_rate' => $this->when($this->user->role === 'admin', $this->hourly_rate),
            // 'company_name' => $this->when($this->user->role === 'admin', $this->company_name)

            
        ];
    }
}
