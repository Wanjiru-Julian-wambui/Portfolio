<?php

namespace App\Http\Controllers;

use App\Http\Resources\SkillResource;
use App\Models\Skill;
use App\Models\Project;
use App\Http\Resources\ProjectResource;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $skills   = SkillResource::collection(Skill::latest()->get())->resolve();
        $projects = ProjectResource::collection(Project::with('skills')->latest()->get())->resolve();

        return inertia('Welcome', compact('skills', 'projects'));
    }
}