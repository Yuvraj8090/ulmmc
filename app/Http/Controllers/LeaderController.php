<?php

namespace App\Http\Controllers;

use App\Models\Leader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class LeaderController extends Controller
{
    public function index()
{
    try {
        $leaders = Leader::orderBy('id', 'asc')->paginate(10); // ✅ not ->get()
        return view('admin.leaders.index', compact('leaders'));
    } catch (Exception $e) {
        Log::error('Error fetching leaders: ' . $e->getMessage());
        return back()->with('error', 'Something went wrong while fetching leaders.');
    }
}


    public function create()
    {
        return view('admin.leaders.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'     => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'image'    => 'nullable',
            ]);

            $data = $request->only('name', 'position');

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('leaders', 'public');
            }

            Leader::create($data);

            return redirect()->route('admin.leaders.index')->with('success', 'Leader added successfully.');
        } catch (Exception $e) {
            Log::error('Error creating leader: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to add leader. Please try again.');
        }
    }

    public function edit(Leader $leader)
    {
        return view('admin.leaders.edit', compact('leader'));
    }

    public function update(Request $request, Leader $leader)
    {
        try {
            $request->validate([
                'name'     => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'image'    => 'nullable',
            ]);

            $data = $request->only('name', 'position');

            if ($request->hasFile('image')) {
                if ($leader->image) {
                    Storage::disk('public')->delete($leader->image);
                }
                $data['image'] = $request->file('image')->store('leaders', 'public');
            }

            $leader->update($data);

            return redirect()->route('admin.leaders.index')->with('success', 'Leader updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating leader: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Failed to update leader. Please try again.');
        }
    }

    public function destroy(Leader $leader)
    {
        try {
            if ($leader->image) {
                Storage::disk('public')->delete($leader->image);
            }
            $leader->delete();

            return redirect()->route('admin.leaders.index')->with('success', 'Leader deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error deleting leader: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete leader. Please try again.');
        }
    }
}
