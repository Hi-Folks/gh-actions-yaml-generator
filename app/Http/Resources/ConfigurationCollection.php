<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ConfigurationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Contracts\Support\Arrayable<int,mixed>|\JsonSerializable|array<int,mixed>
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
