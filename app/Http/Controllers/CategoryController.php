<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        try {
            // Get categories with post counts, paginate 4 per page
            $categories = Category::withCount('posts')
                ->orderBy('name')
                ->paginate(4);
        } catch (\Exception $e) {
            // If relationship fails, get categories and manually count posts
            $categories = Category::orderBy('name')->paginate(4);
            
            // Manually add posts_count to each category
            foreach ($categories as $category) {
                try {
                    $category->posts_count = DB::table('posts')
                        ->where('category_id', $category->id)
                        ->count();
                } catch (\Exception $ex) {
                    $category->posts_count = 0;
                }
            }
        }
        
        // Get total count for header
        $totalCategories = Category::count();
        
        return view('admin.cms-dropdown.categories', compact('categories', 'totalCategories'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string|max:1000'
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('categories')
            ->with('success', 'Category added successfully!');
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:1000'
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('categories')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(Category $category)
    {
        try {
            // Check if category has any posts
            $postsCount = DB::table('posts')
                ->where('category_id', $category->id)
                ->count();
            
            if ($postsCount > 0) {
                return redirect()->route('categories')
                    ->with('error', 'Cannot delete category with existing posts. Move or delete posts first.');
            }
        } catch (\Exception $e) {
            // If posts table doesn't exist or has no category_id column, proceed with deletion
        }
        
        $category->delete();

        return redirect()->route('categories')
            ->with('success', 'Category deleted successfully!');
    }

    /**
     * Bulk delete categories
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'category_ids' => 'required|string'
        ]);

        $categoryIds = json_decode($request->category_ids);
        
        try {
            // Check if any category has posts
            foreach ($categoryIds as $categoryId) {
                $postsCount = DB::table('posts')
                    ->where('category_id', $categoryId)
                    ->count();
                
                if ($postsCount > 0) {
                    return redirect()->route('categories')
                        ->with('error', 'Cannot delete categories with existing posts.');
                }
            }
        } catch (\Exception $e) {
            // If posts table doesn't exist, proceed with deletion
        }
        
        // Delete the categories
        Category::whereIn('id', $categoryIds)->delete();

        return redirect()->route('categories')
            ->with('success', 'Selected categories deleted successfully!');
    }

    /**
     * Get categories for dropdown (used in addpost page)
     */
    public function getForDropdown()
    {
        $categories = Category::orderBy('name')->get(['id', 'name']);
        return response()->json($categories);
    }
}