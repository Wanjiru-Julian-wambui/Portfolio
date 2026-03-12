<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
{
    public function toArray(Request $request): array
{
    $baseUrl = rtrim(config('services.uploadcare.cdn_base'), '/');

    return [
        'id'    => $this->id,
        'name'  => $this->name,
        'image' => $this->image 
            ? "{$baseUrl}/{$this->image}/" 
            : null,
    ];
}
}