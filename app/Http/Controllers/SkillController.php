<?php

namespace App\Http\Controllers;

use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Request;
use Inertia\Inertia;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class SkillController extends Controller
{
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

        $imagePath = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();

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
            $skill->image = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
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