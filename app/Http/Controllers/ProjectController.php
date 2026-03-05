<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Http\Resources\SkillResource;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        return Inertia::render('projects/Index', [
            'projects' => ProjectResource::collection(Project::with('skill')->latest()->get())->resolve(),
            'skills'   => SkillResource::collection(Skill::latest()->get())->resolve(),
        ]);
    }

    public function create()
    {
        return Inertia::render('projects/Create', [
            'skills' => SkillResource::collection(Skill::latest()->get())->resolve(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'skill_id'    => 'required|exists:skills,id',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'project_url' => 'required|url|max:255',
        ]);

        $imagePath = $request->file('image')->store('projects', 'public');

        Project::create([
            'name'        => $request->name,
            'skill_id'    => $request->skill_id,
            'image'       => $imagePath,
            'project_url' => $request->project_url,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'skill_id'    => 'required|exists:skills,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'project_url' => 'required|url|max:255',
        ]);

        $project->name        = $request->name;
        $project->skill_id    = $request->skill_id;
        $project->project_url = $request->project_url;

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($project->image);
            $project->image = $request->file('image')->store('projects', 'public');
        }

        $project->save();

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);

        Storage::disk('public')->delete($project->image);

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}