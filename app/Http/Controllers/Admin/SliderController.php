<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::ordered()->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'badge_1' => 'nullable|string|max:100',
            'badge_2' => 'nullable|string|max:100',
            'heading_normal' => 'required|string|max:255',
            'heading_highlight' => 'required|string|max:255',
            'heading_emoji' => 'nullable|string|max:20',
            'description' => 'required|string|max:1000',
            'btn_primary_text' => 'nullable|string|max:100',
            'btn_primary_link' => 'nullable|string|max:255',
            'btn_secondary_text' => 'nullable|string|max:100',
            'btn_secondary_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'stat_1' => 'nullable|string|max:100',
            'stat_2' => 'nullable|string|max:100',
            'stat_3' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? Slider::max('order') + 1;

        Slider::create($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'স্লাইডার সফলভাবে তৈরি হয়েছে!');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'badge_1' => 'nullable|string|max:100',
            'badge_2' => 'nullable|string|max:100',
            'heading_normal' => 'required|string|max:255',
            'heading_highlight' => 'required|string|max:255',
            'heading_emoji' => 'nullable|string|max:20',
            'description' => 'required|string|max:1000',
            'btn_primary_text' => 'nullable|string|max:100',
            'btn_primary_link' => 'nullable|string|max:255',
            'btn_secondary_text' => 'nullable|string|max:100',
            'btn_secondary_link' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:2048',
            'stat_1' => 'nullable|string|max:100',
            'stat_2' => 'nullable|string|max:100',
            'stat_3' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active');

        $slider->update($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'স্লাইডার সফলভাবে আপডেট হয়েছে!');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'স্লাইডার সফলভাবে ডিলিট হয়েছে!');
    }

    public function toggleActive(Slider $slider)
    {
        $slider->update(['is_active' => !$slider->is_active]);
        return back()->with('success', 'স্ট্যাটাস আপডেট হয়েছে!');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:sliders,id',
        ]);

        foreach ($request->order as $position => $id) {
            Slider::where('id', $id)->update(['order' => $position]);
        }

        return response()->json(['success' => true]);
    }
}
