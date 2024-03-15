<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfigurationResource extends JsonResource
{
    public string $code;

    public int $counts;

    public string $created_at;

    public string $updated_at;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'code' => $this->code,
            'counts' => $this->counts,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
