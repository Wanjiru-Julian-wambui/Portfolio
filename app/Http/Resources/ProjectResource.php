<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
{
    $baseUrl = rtrim(config('services.uploadcare.cdn_base'), '/');

    return [
        'id'          => $this->id,
        'name'        => $this->name,
        'description' => $this->description,
        // Use the dynamic base URL
        'image'       => $this->image ? "{$baseUrl}/{$this->image}/" : null,
        'project_url' => $this->project_url,
        'skill_ids'   => $this->whenLoaded('skills', fn() => $this->skills->pluck('id')),
        'skills'      => $this->whenLoaded('skills', fn() => $this->skills->map(fn($skill) => [
            'id'    => $skill->id,
            'name'  => $skill->name,
            // Apply the same fix to nested skill images
            'image' => $skill->image ? "{$baseUrl}/{$skill->image}/" : null,
        ])),
    ];
}
}