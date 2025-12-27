<?php

namespace App\Http\Controllers;

use App\Helpers\ContentHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts
     */
    public function index()
    {
        $posts = ContentHelper::getBlogPosts();
        // Ensure posts is always an array
        if (!is_array($posts)) {
            $posts = [];
        }
        return view('dashboard.blog.index', compact('posts'));
    }
    
    /**
     * Show the form for creating a new blog post
     */
    public function create()
    {
        return view('dashboard.blog.create');
    }
    
    /**
     * Store a newly created blog post
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'date' => 'required|date',
            'read_time' => 'nullable|string|max:50',
            'category' => 'required|string|max:100',
            'status' => 'required|string|in:published,draft',
        ], [
            'title.required' => 'عنوان المقال مطلوب',
            'excerpt.required' => 'الملخص مطلوب',
            'content.required' => 'محتوى المقال مطلوب',
            'author.required' => 'اسم الكاتب مطلوب',
            'date.required' => 'تاريخ النشر مطلوب',
            'category.required' => 'التصنيف مطلوب',
            'status.required' => 'الحالة مطلوبة',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        try {
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('blog', 'public');
            }
            
            $postData = [
                'title' => $request->input('title'),
                'slug' => $request->input('slug') ?: \Str::slug($request->input('title')),
                'excerpt' => $request->input('excerpt'),
                'content' => $request->input('content'),
                'author' => $request->input('author'),
                'date' => $request->input('date'),
                'read_time' => $request->input('read_time') ?: '5 دقائق',
                'category' => $request->input('category'),
                'status' => $request->input('status'),
                'image' => $imagePath,
            ];
            
            $id = ContentHelper::addBlogPost($postData);
            
            return redirect()->route('dashboard.blog.index')
                ->with('success', 'تم إضافة المقال بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء إضافة المقال: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Display the specified blog post
     */
    public function show($id)
    {
        $post = ContentHelper::getBlogPost($id);
        
        if (!$post) {
            return redirect()->route('dashboard.blog.index')
                ->with('error', 'المقال غير موجود');
        }
        
        return view('dashboard.blog.show', compact('post'));
    }
    
    /**
     * Show the form for editing the specified blog post
     */
    public function edit($id)
    {
        $post = ContentHelper::getBlogPost($id);
        
        if (!$post) {
            return redirect()->route('dashboard.blog.index')
                ->with('error', 'المقال غير موجود');
        }
        
        return view('dashboard.blog.edit', compact('post'));
    }
    
    /**
     * Update the specified blog post
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'date' => 'required|date',
            'read_time' => 'nullable|string|max:50',
            'category' => 'required|string|max:100',
            'status' => 'required|string|in:published,draft',
        ], [
            'title.required' => 'عنوان المقال مطلوب',
            'excerpt.required' => 'الملخص مطلوب',
            'content.required' => 'محتوى المقال مطلوب',
            'author.required' => 'اسم الكاتب مطلوب',
            'date.required' => 'تاريخ النشر مطلوب',
            'category.required' => 'التصنيف مطلوب',
            'status.required' => 'الحالة مطلوبة',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        try {
            $existingPost = ContentHelper::getBlogPost($id);
            
            // Handle image upload
            $imagePath = $existingPost['image'] ?? null;
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                // Upload new image
                $image = $request->file('image');
                $imagePath = $image->store('blog', 'public');
            }
            
            $postData = [
                'title' => $request->input('title'),
                'slug' => $request->input('slug') ?: \Str::slug($request->input('title')),
                'excerpt' => $request->input('excerpt'),
                'content' => $request->input('content'),
                'author' => $request->input('author'),
                'date' => $request->input('date'),
                'read_time' => $request->input('read_time') ?: '5 دقائق',
                'category' => $request->input('category'),
                'status' => $request->input('status'),
                'image' => $imagePath,
            ];
            
            ContentHelper::updateBlogPost($id, $postData);
            
            return redirect()->route('dashboard.blog.index')
                ->with('success', 'تم تحديث المقال بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء تحديث المقال: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Remove the specified blog post
     */
    public function destroy($id)
    {
        try {
            ContentHelper::deleteBlogPost($id);
            
            return redirect()->route('dashboard.blog.index')
                ->with('success', 'تم حذف المقال بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء حذف المقال: ' . $e->getMessage());
        }
    }
}

