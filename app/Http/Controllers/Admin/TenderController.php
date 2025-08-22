<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tender;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TenderController extends Controller
{
    /**
     * Display a listing of the tenders.
     */
    public function index()
    {
        $tenders = Tender::latest()->paginate(10);
        return view('admin.tenders.index', compact('tenders'));
    }

    /**
     * Show the form for creating a new tender.
     */
    public function create()
    {
        return view('admin.tenders.create');
    }

    /**
     * Store a newly created tender in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_hi' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_hi' => 'nullable|string',
            'open_date' => 'required|date',
            'close_date' => 'required|date|after_or_equal:open_date',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // max 10MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tenders', 'public');
        }

        Tender::create([
            'title_en' => $request->title_en,
            'title_hi' => $request->title_hi,
            'description_en' => $request->description_en,
            'description_hi' => $request->description_hi,
            'open_date' => $request->open_date,
            'close_date' => $request->close_date,
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.tenders.index')->with('success', 'Tender created successfully.');
    }

    /**
     * Show the form for editing the specified tender.
     */
    public function edit(Tender $tender)
    {
        return view('admin.tenders.edit', compact('tender'));
    }



public function publicIndex()
{
    $now = Carbon::now();

    $tenders = Tender::where('close_date', '>=', $now)
                     ->orderBy('open_date', 'desc')
                     ->get();

    // Pass a variable to indicate language
    $lang = 'en';

    return view('tenders.index', compact('tenders', 'lang'));
}

public function publicIndexHI()
{
    $now = Carbon::now();

    $tenders = Tender::where('close_date', '>=', $now)
                     ->orderBy('open_date', 'desc')
                     ->get();

    $lang = 'hi';

    return view('tenders.index', compact('tenders', 'lang'));
}



    /**
     * Update the specified tender in storage.
     */
    public function update(Request $request, Tender $tender)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_hi' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_hi' => 'nullable|string',
            'open_date' => 'required|date',
            'close_date' => 'required|date|after_or_equal:open_date',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($tender->file_path) {
                Storage::disk('public')->delete($tender->file_path);
            }
            $tender->file_path = $request->file('file')->store('tenders', 'public');
        }

        $tender->update([
            'title_en' => $request->title_en,
            'title_hi' => $request->title_hi,
            'description_en' => $request->description_en,
            'description_hi' => $request->description_hi,
            'open_date' => $request->open_date,
            'close_date' => $request->close_date,
        ]);

        return redirect()->route('admin.tenders.index')->with('success', 'Tender updated successfully.');
    }

    /**
     * Remove the specified tender from storage.
     */
    public function destroy(Tender $tender)
    {
        if ($tender->file_path) {
            Storage::disk('public')->delete($tender->file_path);
        }

        $tender->delete();

        return redirect()->route('admin.tenders.index')->with('success', 'Tender deleted successfully.');
    }

    /**
     * Download the tender file.
     */
    public function download(Tender $tender)
    {
        if (!$tender->file_path || !Storage::disk('public')->exists($tender->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        return Storage::disk('public')->download($tender->file_path);
    }
}
