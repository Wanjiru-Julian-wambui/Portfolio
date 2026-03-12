<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Http\Resources\SkillResource;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class ProjectController extends Controller
{
    private function uploadToUploadcare($file): string
    {
        $response = Http::asMultipart()->post(
            'https://upload.uploadcare.com/base/',
            [
                ['name' => 'UPLOADCARE_PUB_KEY',  'contents' => config('services.uploadcare.public_key')],
                ['name' => 'UPLOADCARE_STORE',     'contents' => '1'],
                ['name' => 'file',                 'contents' => fopen($file->getRealPath(), 'r'), 'filename' => $file->getClientOriginalName()],
            ]
        );

        $fileId = $response->json()['file'];
        return 'https://ucarecdn.com/' . $fileId . '/';
    }

    private function deleteFromUploadcare(string $fileUrl): void
    {
        $fileId = basename(rtrim($fileUrl, '/'));

        Http::withHeaders([
            'Authorization' => 'Uploadcare.Simple ' . config('services.uploadcare.public_key') . ':' . config('services.uploadcare.secret_key'),
        ])->delete('https://api.uploadcare.com/files/' . $fileId . '/');
    }

    public function index()
    {
        return Inertia::render('projects/Index', [
            'projects' => ProjectResource::collection(Project::with('skills')->latest()->get())->resolve(),
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
            'skill_ids'   => 'required|array|min:1',
            'skill_ids.*' => 'exists:skills,id',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'project_url' => 'required|url|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $imagePath = $this->uploadToUploadcare($request->file('image'));

        $project = Project::create([
            'name'        => $request->name,
            'image'       => $imagePath,
            'project_url' => $request->project_url,
            'description' => $request->description,
        ]);

        $project->skills()->sync($request->skill_ids);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        //
    }

    public function edit(Project $project)
    {
        //
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'skill_ids'   => 'required|array|min:1',
            'skill_ids.*' => 'exists:skills,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'project_url' => 'required|url|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $project->name        = $request->name;
        $project->project_url = $request->project_url;
        $project->description = $request->description;

        if ($request->hasFile('image')) {
            $this->deleteFromUploadcare($project->image);
            $project->image = $this->uploadToUploadcare($request->file('image'));
        }

        $project->save();
        $project->skills()->sync($request->skill_ids);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $this->deleteFromUploadcare($project->image);
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}