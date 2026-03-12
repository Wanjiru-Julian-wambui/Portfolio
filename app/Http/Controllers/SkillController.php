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
                ['name' => 'UPLOADCARE_PUB_KEY',  'contents' => config('services.uploadcare.public_key')],
                ['name' => 'UPLOADCARE_STORE',     'contents' => '1'],
                ['name' => 'file',                 'contents' => fopen($file->getRealPath(), 'r'), 'filename' => $file->getClientOriginalName()],
            ]
        );

        if ($response->failed() || empty($response->json()['file'])) {
            logger()->error('Uploadcare upload failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            throw new \RuntimeException('Image upload failed. Please try again.');
        }

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

        $imagePath = $this->uploadToUploadcare($request->file('image'));

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
            $this->deleteFromUploadcare($skill->image);
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