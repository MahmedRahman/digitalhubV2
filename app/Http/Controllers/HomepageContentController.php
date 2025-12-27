<?php

namespace App\Http\Controllers;

use App\Helpers\ContentHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomepageContentController extends Controller
{
    /**
     * Display the homepage editor (Elementor-like interface)
     */
    public function index()
    {
        $content = ContentHelper::getHomepageContent();
        return view('dashboard.homepage.index', compact('content'));
    }
    
    /**
     * Get homepage content (API)
     */
    public function getContent()
    {
        $content = ContentHelper::getHomepageContent();
        return response()->json($content);
    }
    
    /**
     * Update homepage content
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|array'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'البيانات غير صحيحة',
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            ContentHelper::saveHomepageContent($request->input('content'));
            
            return response()->json([
                'success' => true,
                'message' => 'تم حفظ التغييرات بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء الحفظ: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Preview homepage with current changes
     */
    public function preview()
    {
        $content = ContentHelper::getHomepageContent();
        return view('home', ['content' => $content, 'editor_mode' => false]);
    }
    
    /**
     * Upload image for homepage section
     */
    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'section' => 'required|string',
            'field' => 'required|string'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'البيانات غير صحيحة',
                'errors' => $validator->errors()
            ], 422);
        }
        
        try {
            $image = $request->file('image');
            $section = $request->input('section');
            $field = $request->input('field');
            
            // Generate unique filename
            $filename = $section . '_' . $field . '_' . time() . '.' . $image->getClientOriginalExtension();
            
            // Store image
            $path = $image->storeAs('homepage', $filename, 'public');
            
            // Update content
            $content = ContentHelper::getHomepageContent();
            if (!isset($content[$section])) {
                $content[$section] = [];
            }
            $content[$section][$field] = $path;
            ContentHelper::saveHomepageContent($content);
            
            return response()->json([
                'success' => true,
                'message' => 'تم رفع الصورة بنجاح',
                'image_path' => $path,
                'image_url' => asset('storage/' . $path)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ: ' . $e->getMessage()
            ], 500);
        }
    }
}

