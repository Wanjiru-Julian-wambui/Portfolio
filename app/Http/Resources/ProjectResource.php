<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
   public function toArray(Request $request): array
{
    return [
        'id'          => $this->id,
        'name'        => $this->name,
        'skill_id'    => $this->skill_id,
        'skill'       => (new SkillResource($this->whenLoaded('skill')))->resolve(),
        'image'       => asset('storage/' . $this->image),
        'project_url' => $this->project_url,
    ];
}
}