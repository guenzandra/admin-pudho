<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     */
    public function index()
    {
        $posts = Post::with(['category', 'user'])->orderBy('created_at', 'desc')->get();
        return view('admin.cms-dropdown.allpost', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.cms-dropdown.addpost', compact('categories'));
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        // Log the request for debugging
        Log::info('Post creation started', ['request' => $request->except(['content'])]);

        // Validate request
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'content' => 'required|string',
            'status' => 'required|in:publish,draft',
            'photos' => 'nullable|array|max:5',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'videos' => 'nullable|array|max:3',
            'videos.*' => 'nullable|mimes:mp4,mov,avi|max:51200'
        ]);

        if ($validator->fails()) {
            Log::warning('Post validation failed', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        
        try {
            // Handle media uploads
            $mediaPaths = [];
            
            // Handle photos
            if ($request->hasFile('photos')) {
                foreach ($request->file('photos') as $key => $photo) {
                    if ($photo && $photo->isValid()) {
                        // Generate unique filename
                        $filename = time() . '_' . uniqid() . '_' . $photo->getClientOriginalName();
                        $path = $photo->storeAs('posts/photos', $filename, 'public');
                        $mediaPaths['photos'][] = $path;
                        Log::info('Photo uploaded', ['path' => $path]);
                    }
                }
            }
            
            // Handle videos
            if ($request->hasFile('videos')) {
                foreach ($request->file('videos') as $key => $video) {
                    if ($video && $video->isValid()) {
                        // Generate unique filename
                        $filename = time() . '_' . uniqid() . '_' . $video->getClientOriginalName();
                        $path = $video->storeAs('posts/videos', $filename, 'public');
                        $mediaPaths['videos'][] = $path;
                        Log::info('Video uploaded', ['path' => $path]);
                    }
                }
            }

            // Get the current user ID from session/auth
            // For now, let's get the first admin user if no auth
            $user = User::where('role_no', 1)->first();
            
            if (!$user) {
                // If no admin, get any non-anonymous user
                $user = User::where('is_anonymous', false)->first();
            }
            
            if (!$user) {
                // If still no user, create a temporary one
                $user = User::create([
                    'first_name' => 'System',
                    'last_name' => 'Admin',
                    'email' => 'system@example.com',
                    'username' => 'system_admin',
                    'role_no' => 1,
                    'is_anonymous' => false,
                    'is_active' => true,
                    'password' => Hash::make('password123')
                ]);
                Log::info('System user created');
            }

            // Create post
            $post = Post::create([
                'user_id' => $user->user_id,
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'media_path' => !empty($mediaPaths) ? json_encode($mediaPaths) : null,
                'status' => $request->status
            ]);

            DB::commit();
            Log::info('Post created successfully', ['post_id' => $post->id, 'status' => $request->status]);

            $message = $request->status === 'publish' 
                ? 'Post published successfully!' 
                : 'Draft saved successfully!';
            
            $submessage = $request->status === 'publish'
                ? 'Your article is now live'
                : 'You can continue editing later';

            return response()->json([
                'success' => true,
                'message' => $message,
                'submessage' => $submessage,
                'post' => $post
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Post creation error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Error creating post: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload media files via AJAX (chunked upload)
     */
    public function uploadMedia(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'file' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:51200',
                'type' => 'required|in:photo,video'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }

            $file = $request->file('file');
            $type = $request->type === 'photo' ? 'photos' : 'videos';
            
            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs("posts/{$type}", $filename, 'public');

            Log::info('Media uploaded via AJAX', ['path' => $path, 'type' => $type]);

            return response()->json([
                'success' => true,
                'path' => $path,
                'url' => Storage::url($path)
            ]);
            
        } catch (\Exception $e) {
            Log::error('Media upload error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error uploading file: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified post.
     */
    public function show(Post $post)
    {
        $post->load(['category', 'user']);
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.cms-dropdown.editpost', compact('post', 'categories'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'content' => 'required|string',
            'status' => 'required|in:publish,draft'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $post->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'content' => $request->content,
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Post updated successfully!',
                'post' => $post
            ]);
            
        } catch (\Exception $e) {
            Log::error('Post update error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating post',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        try {
            // Delete media files
            if ($post->media_path) {
                $mediaPaths = json_decode($post->media_path, true);
                if (isset($mediaPaths['photos'])) {
                    foreach ($mediaPaths['photos'] as $photo) {
                        Storage::disk('public')->delete($photo);
                    }
                }
                if (isset($mediaPaths['videos'])) {
                    foreach ($mediaPaths['videos'] as $video) {
                        Storage::disk('public')->delete($video);
                    }
                }
            }

            $post->delete();

            return response()->json([
                'success' => true,
                'message' => 'Post moved to trash successfully!'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Post deletion error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error deleting post',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}