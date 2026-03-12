<?php

namespace App\Http\Controllers;

use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class SkillController extends Controller
{
    private function uploadToUploadcare($file): string
    {
        $response = Http::asMultipart()->post(
            'https://upload.uploadcare.com/base/',
            [
                ['name' => 'UPLOADCARE_PUB_KEY', 'contents' => config('services.uploadcare.public_key')],
                ['name' => 'UPLOADCARE_STORE', 'contents' => '1'],
                ['name' => 'file', 'contents' => fopen($file->getRealPath(), 'r'), 'filename' => $file->getClientOriginalName()],
            ]
        );

        if ($response->failed() || empty($response->json()['file'])) {
            logger()->error('Uploadcare upload failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            throw new \RuntimeException('Image upload failed. Please try again.');
        }

        // Store only the UUID
        return $response->json()['file'];
    }

    private function deleteFromUploadcare(string $fileId): void
    {
        // Extract UUID if full URL was stored (for backward compatibility)
        if (str_contains($fileId, 'ucarecdn.com') || str_contains($fileId, 'ucarecd.net')) {
            $parts = explode('/', trim($fileId, '/'));
            // Find the UUID part (should be a valid UUID format)
            foreach ($parts as $part) {
                if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $part)) {
                    $fileId = $part;
                    break;
                }
            }
        }

        Http::withHeaders([
            'Authorization' => 'Uploadcare.Simple ' . config('services.uploadcare.public_key') . ':' . config('services.uploadcare.secret_key'),
        ])->delete('https://api.uploadcare.com/files/' . $fileId . '/');
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
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
        ]);

        $imageUuid = $this->uploadToUploadcare($request->file('image'));

        Skill::create([
            'name' => $request->name,
            'image' => $imageUuid, // Store only the UUID
        ]);

        return redirect()->route('skills.index')->with('success', 'Skill created successfully.');
    }

    public function show(Skill $skill)
    {
        //
    }

    public function edit(Skill $skill)
    {
        return Inertia::render('skills/Edit', [
            'skill' => new SkillResource($skill),
        ]);
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $skill->name = $request->name;

        if ($request->hasFile('image')) {
            // Delete old image
            $this->deleteFromUploadcare($skill->image);
            
            // Upload new image and store UUID
            $skill->image = $this->uploadToUploadcare($request->file('image'));
        }

        $skill->save();

        return redirect()->route('skills.index')->with('success', 'Skill updated successfully.');
    }

    public function destroy(Skill $skill)
    {
        $this->deleteFromUploadcare($skill->image);
        $skill->delete();
        return redirect()->route('skills.index')->with('success', 'Skill deleted successfully.');
    }
}