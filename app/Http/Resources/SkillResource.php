<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
{
    public function toArray(Request $request): array
{
    return [
        'id'    => $this->id,
        'name'  => $this->name,
        // Only build the URL if the UUID exists
        'image' => $this->image 
            ? "https://ucarecdn.net/{$this->image}/" 
            : null,
    ];
}
}