<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class EditorController extends Controller
{
    /**
     * Display editor dashboard
     */
    public function index()
    {
        // This will look for: resources/views/editor/editor_dashboard.blade.php
        return view('editor.editorDashboard');
    }
    
    /**
     * Display editor dashboard (alternative)
     */
    public function dashboard()
    {
        $totalPosts = Post::count();
        $recentPosts = Post::with('category')
                          ->latest()
                          ->take(5)
                          ->get();
        
        // This also uses editor_dashboard.blade.php
        return view('editor.editorDashboard', compact('totalPosts', 'recentPosts'));
    }
    
    /**
     * NEW METHOD: editor_dashboard - para sa direct route
     */
    public function editor_dashboard()
    {
        // Pwedeng same lang sa dashboard() method
        $totalPosts = Post::count();
        $recentPosts = Post::with('category')
                          ->latest()
                          ->take(5)
                          ->get();
        
        return view('editor.editorDashboard', compact('totalPosts', 'recentPosts'));
    }
}