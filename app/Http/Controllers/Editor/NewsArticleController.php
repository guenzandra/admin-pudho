<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsArticleController extends Controller
{
  public function index()
  {
    return view('editor.news');
  }

  public function getData(Request $request)
  {
    $query = NewsArticle::query();

    if ($request->has('search') && $request->search) {
      $search = $request->search;
      $query->where('title', 'like', "%{$search}%")
        ->orWhere('content', 'like', "%{$search}%");
    }

    if ($request->has('category') && $request->category) {
      $query->where('category', $request->category);
    }

    if ($request->has('year') && $request->year) {
      $query->whereYear('date', $request->year);
    }

    $query->orderBy('date', 'desc');
    $articles = $query->get();

    $articlesData = $articles->map(function ($item) {
      // Get author name
      $authorName = 'Unknown';
      if ($item->author) {
        $author = User::where('user_id', $item->author)->first();
        if ($author) {
          $authorName = $author->first_name . ' ' . $author->last_name;
        }
      }

      return [
        'id' => $item->id,
        'title' => $item->title,
        'desc' => $item->excerpt ?: Str::limit(strip_tags($item->content), 100),
        'content' => $item->content,
        'category' => $item->category,
        'author' => $authorName,
        'tags' => $item->tags ?? [],
        'img' => $item->image ? Storage::url($item->image) : null,
        'date' => $item->date ? $item->date->format('M j, Y') : '',
        'year' => $item->date ? $item->date->year : null
      ];
    });

    $stats = [
      'total' => NewsArticle::count(),
      'published' => NewsArticle::count(),
      'draft' => 0,
      'scheduled' => 0
    ];

    return response()->json([
      'success' => true,
      'data' => $articlesData,
      'stats' => $stats
    ]);
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
      'category' => 'required|string|max:100',
      'tags' => 'nullable|json',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
    ]);

    $imagePath = null;
    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('news-images', 'public');
    }

    $article = NewsArticle::create([
      'title' => $request->title,
      'excerpt' => Str::limit(strip_tags($request->content), 150),
      'content' => $request->content,
      'category' => $request->category,
      'tags' => json_decode($request->tags, true) ?? [],
      'image' => $imagePath,
      'author' => Auth::id(), // Using 'author' column, not 'author_id'
      'date' => now()
    ]);

    return response()->json([
      'success' => true,
      'message' => 'Article created successfully',
      'data' => $article
    ]);
  }

  public function update(Request $request, $id)
  {
    $article = NewsArticle::findOrFail($id);

    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
      'category' => 'required|string|max:100',
      'tags' => 'nullable|json',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
    ]);

    if ($request->hasFile('image')) {
      if ($article->image) {
        Storage::disk('public')->delete($article->image);
      }
      $article->image = $request->file('image')->store('news-images', 'public');
    }

    $article->title = $request->title;
    $article->excerpt = Str::limit(strip_tags($request->content), 150);
    $article->content = $request->content;
    $article->category = $request->category;
    $article->tags = json_decode($request->tags, true) ?? [];
    $article->save();

    return response()->json([
      'success' => true,
      'message' => 'Article updated successfully',
      'data' => $article
    ]);
  }

  public function destroy($id)
  {
    $article = NewsArticle::findOrFail($id);
    if ($article->image) {
      Storage::disk('public')->delete($article->image);
    }
    $article->delete();

    return response()->json([
      'success' => true,
      'message' => 'Article deleted successfully'
    ]);
  }
}
