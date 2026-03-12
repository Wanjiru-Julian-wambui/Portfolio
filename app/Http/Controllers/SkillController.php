<?php

namespace App\Http\Controllers;

use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SkillController extends Controller
{
    private function uploadToCloudinary($file): string
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME');
        $preset = env('CLOUDINARY_UPLOAD_PRESET');

        Log::error('Cloud name: ' . $cloudName);
        Log::error('Preset: ' . $preset);

        $response = Http::asMultipart()->post(
            'https://api.cloudinary.com/v1_1/' . $cloudName . '/image/upload',
            [
                [
                    'name'     => 'file',
                    'contents' => fopen($file->getRealPath(), 'r'),
                    'filename' => $file->getClientOriginalName(),
                ],
                [
                    'name'     => 'upload_preset',
                    'contents' => $preset,
                ],
            ]
        );

        Log::error('Cloudinary status: ' . $response->status());
        Log::error('Cloudinary response: ' . json_encode($response->json()));

        return $response->json()['secure_url'];
    }

    public function index()
    {
        return Inertia::render('skills/Index', [
            'skills' => SkillResource::collection(Skill::latest()->get())->resolve(),
        ]);
    }

    public function create()
    {
        return Inertia::render('skills/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
        ]);

        $imagePath = $this->uploadToCloudinary($request->file('image'));

        Skill::create([
            'name'  => $request->name,
            'image' => $imagePath,
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill created successfully.');
    }

    public function show(Skill $skill)
    {
        //
    }

    public function edit(Skill $skill)
    {
        //
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $skill->name = $request->name;

        if ($request->hasFile('image')) {
            $skill->image = $this->uploadToCloudinary($request->file('image'));
        }

        $skill->save();

        return redirect()->route('skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('skills.index')->with('success', 'Skill deleted successfully.');
    }
}