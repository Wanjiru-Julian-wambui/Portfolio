<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'image'       => $this->image ? Storage::url($this->image) : null,
            'project_url' => $this->project_url,
            'skill_ids'   => $this->whenLoaded('skills', fn() => $this->skills->pluck('id')),
            'skills'      => $this->whenLoaded('skills', fn() => $this->skills->map(fn($skill) => [
                'id'    => $skill->id,
                'name'  => $skill->name,
                'image' => $skill->image ? Storage::url($skill->image) : null,
            ])),
        ];
    }
}