<?php

namespace App\Http\Controllers\Editor;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
  public function index()
  {
    return view('editor.announcements');
  }

  public function getData(Request $request)
  {
    $query = Announcement::query();

    // Apply year filter
    if ($request->has('year') && $request->year) {
      $query->whereYear('created_at', $request->year);
    }

    // Apply month filter
    if ($request->has('month') && $request->month !== '') {
      $query->whereMonth('created_at', (int)$request->month + 1);
    }

    // Apply status filter
    if ($request->has('status') && $request->status) {
      $query->where('status', $request->status);
    }

    // Apply search filter
    if ($request->has('search') && $request->search) {
      $search = $request->search;
      $query->where('title', 'like', "%{$search}%");
    }

    // Apply sorting
    $sortDir = $request->get('sort_dir', 'desc');
    $query->orderBy('created_at', $sortDir);

    $perPage = $request->get('per_page', 6);
    $announcements = $query->paginate($perPage);

    // Transform data for frontend
    $announcementsData = $announcements->map(function ($item) {
      // Manually get author name
      $authorName = 'Unknown';
      if ($item->author_id) {
        $author = User::find($item->author_id);
        if ($author) {
          $authorName = $author->first_name . ' ' . $author->last_name;
        }
      }

      return [
        'id' => $item->id,
        'title' => $item->title,
        'desc' => Str::limit(strip_tags($item->content), 70),
        'content' => $item->content,
        'dateObj' => $item->created_at ? $item->created_at->toISOString() : now()->toISOString(),
        'status' => $item->status,
        'author' => $authorName,
        'img' => $item->image ? Storage::url($item->image) : null,
        'scheduled_date' => $item->scheduled_date
      ];
    });

    // Get statistics
    $stats = [
      'total' => Announcement::count(),
      'published' => Announcement::where('status', 'published')->count(),
      'draft' => Announcement::where('status', 'draft')->count(),
      'scheduled' => Announcement::where('status', 'scheduled')->count()
    ];

    // Get available years
    $years = Announcement::selectRaw('YEAR(created_at) as year')
      ->distinct()
      ->orderBy('year', 'desc')
      ->pluck('year');

    return response()->json([
      'success' => true,
      'data' => $announcementsData,
      'stats' => $stats,
      'years' => $years,
      'current_page' => $announcements->currentPage(),
      'last_page' => $announcements->lastPage(),
      'per_page' => $announcements->perPage(),
      'total' => $announcements->total()
    ]);
  }

  public function show($id)
  {
    $announcement = Announcement::with('author')->findOrFail($id);
    return response()->json([
      'success' => true,
      'data' => [
        'id' => $announcement->id,
        'title' => $announcement->title,
        'content' => $announcement->content,
        'status' => $announcement->status,
        'author' => $announcement->author ? $announcement->author->name : 'Unknown',
        'img' => $announcement->image ? Storage::url($announcement->image) : null,
        'scheduled_date' => $announcement->scheduled_date
      ]
    ]);
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
      'status' => 'required|in:draft,published,scheduled',
      'author' => 'required|string|max:255',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
      'scheduled_date' => 'required_if:status,scheduled|nullable|date'
    ]);

    // Handle image upload
    $imagePath = null;
    if ($request->hasFile('image')) {
      $imagePath = $request->file('image')->store('announcements', 'public');
    } elseif ($request->has('image_data') && $request->image_data) {
      $imagePath = $this->saveBase64Image($request->image_data);
    }

    $announcement = Announcement::create([
      'title' => $request->title,
      'content' => $request->content,
      'image' => $imagePath,
      'status' => $request->status,
      'author_id' => Auth::id(),
      'scheduled_date' => $request->status === 'scheduled' ? $request->scheduled_date : null,
      'published_at' => $request->status === 'published' ? now() : null
    ]);

    return response()->json([
      'success' => true,
      'message' => 'Announcement created successfully',
      'data' => $announcement
    ]);
  }

  public function update(Request $request, $id)
  {
    $announcement = Announcement::findOrFail($id);

    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'content' => 'required|string',
      'status' => 'required|in:draft,published,scheduled',
      'author' => 'required|string|max:255',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
      'scheduled_date' => 'required_if:status,scheduled|nullable|date'
    ]);

    // Handle image update
    if ($request->hasFile('image')) {
      if ($announcement->image) {
        Storage::disk('public')->delete($announcement->image);
      }
      $imagePath = $request->file('image')->store('announcements', 'public');
      $announcement->image = $imagePath;
    } elseif ($request->has('image_data') && $request->image_data) {
      if ($announcement->image) {
        Storage::disk('public')->delete($announcement->image);
      }
      $announcement->image = $this->saveBase64Image($request->image_data);
    } elseif ($request->has('remove_image') && $request->remove_image) {
      if ($announcement->image) {
        Storage::disk('public')->delete($announcement->image);
      }
      $announcement->image = null;
    }

    $announcement->title = $request->title;
    $announcement->content = $request->content;
    $announcement->status = $request->status;
    $announcement->scheduled_date = $request->status === 'scheduled' ? $request->scheduled_date : null;
    $announcement->published_at = $request->status === 'published' ? now() : null;
    $announcement->save();

    return response()->json([
      'success' => true,
      'message' => 'Announcement updated successfully',
      'data' => $announcement
    ]);
  }

  public function destroy($id)
  {
    $announcement = Announcement::findOrFail($id);

    if ($announcement->image) {
      Storage::disk('public')->delete($announcement->image);
    }

    $announcement->delete();

    return response()->json([
      'success' => true,
      'message' => 'Announcement deleted successfully'
    ]);
  }

  public function toggleStatus($id)
  {
    $announcement = Announcement::findOrFail($id);

    $newStatus = $announcement->status === 'published' ? 'draft' : 'published';
    $announcement->status = $newStatus;
    $announcement->published_at = $newStatus === 'published' ? now() : null;
    $announcement->save();

    return response()->json([
      'success' => true,
      'message' => 'Status updated successfully',
      'status' => $newStatus
    ]);
  }

  private function saveBase64Image($base64Image)
  {
    if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
      $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
      $type = strtolower($type[1]);

      if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
        return null;
      }

      $base64Image = str_replace(' ', '+', $base64Image);
      $imageData = base64_decode($base64Image);

      if ($imageData === false) {
        return null;
      }

      $filename = 'announcements/' . uniqid() . '.' . $type;
      Storage::disk('public')->put($filename, $imageData);

      return $filename;
    }

    return null;
  }
}
