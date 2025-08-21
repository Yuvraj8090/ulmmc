<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Exception;

class NewsController extends Controller
{
    // List all news
    public function listNews()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    // Show create form
    public function showCreateForm()
    {
        return view('admin.news.create');
    }

    // Store new news
    public function createNews(Request $request)
    {
        try {
            $validated = $request->validate([
                'title'            => 'required|string|max:255',
                'title_hi'         => 'nullable|string|max:255',
                'body_eng'         => 'required|string',
                'body_hindi'       => 'nullable|string',
                'meta_title'       => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keywords'    => 'nullable|string',
            ]);

            $validated['slug'] = News::createSlug($validated['title']);
            $validated['status'] = 0; // default inactive
            News::create($validated);

            return redirect()->route('admin.news.list')->with('success', 'News created successfully.');
        } catch (Exception $e) {
            Log::error('Error creating news: ' . $e->getMessage());
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    // Show edit form
    public function showEditForm($id)
    {
        $news = News::findOrFail($id);
        return view('admin.news.edit', compact('news'));
    }

    // Validation rules (shared)
    private function validateNewsRequest(Request $request, $id = null)
    {
        return $request->validate([
            'title'            => 'required|string|max:255',
            'title_hi'         => 'nullable|string|max:255',
            'slug'             => 'sometimes|string|max:255|unique:news,slug,' . $id,
            'body_eng'         => 'required|string',
            'body_hindi'       => 'nullable|string',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords'    => 'nullable|string',
        ]);
    }

    // Update news
    public function updateNews(Request $request, $id)
    {
        try {
            $news = News::findOrFail($id);
            $validated = $this->validateNewsRequest($request, $news->id);
            $validated['status'] = $request->input('status') == '1' ? 1 : 0;

            $news->update($validated);

            return redirect()->route('admin.news.list')->with('success', 'News updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating news: ' . $e->getMessage());
            return back()->withErrors('Unexpected error occurred.')->withInput();
        }
    }

    // Delete news
    public function deleteNews($id)
    {
        try {
            $news = News::findOrFail($id);
            $news->delete();
            return redirect()->route('admin.news.list')->with('success', 'News deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error deleting news: ' . $e->getMessage());
            return redirect()->route('admin.news.list')->withErrors('Failed to delete news.');
        }
    }

    // Show single news (English)
public function showNews($slug)
{
    $news = News::where('slug', $slug)
                ->where('status', 1)
                ->firstOrFail();

    $page = (object) [
        'title'           => $news->title,
        'title_hi'        => $news->title_hi,
        'translated_title'=> $news->title,
    ];

    $body = $news->body_eng;

    $breadcrumbs = [
        ['slug' => 'news', 'title' => 'News'],
        ['slug' => $news->slug, 'title' => $news->title],
    ];

    $sidebarItems = News::where('status', 1)->latest()->take(10)->get();

    return view('news.show', compact('news', 'page', 'body', 'breadcrumbs', 'sidebarItems'));
}

// Show single news (Hindi)
public function showNewsHi($slug)
{
    App::setLocale('hi');
    $translator = new GoogleTranslate('hi');

    $news = News::where('slug', $slug)
                ->where('status', 1)
                ->firstOrFail();

    $title = $news->title_hi ?: $translator->translate($news->title);
    $body  = $news->body_hindi ?: $translator->translate($news->body_eng);

    $page = (object) [
        'title'           => $news->title,
        'title_hi'        => $title,
        'translated_title'=> $title,
    ];

    $breadcrumbs = [
        ['slug_hi' => 'samachar', 'title_hi' => 'समाचार', 'slug' => 'news', 'title' => 'News'],
        ['slug' => $news->slug, 'slug_hi' => $news->slug, 'title' => $title, 'title_hi' => $title],
    ];

    $sidebarItems = News::where('status', 1)->latest()->take(10)->get();

    return view('news.show', compact('news', 'page', 'body', 'title', 'breadcrumbs', 'sidebarItems'));
}

}
