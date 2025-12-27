<?php

namespace App\Http\Controllers;

use App\Helpers\ContentHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutContentController extends Controller
{
    /**
     * Display the about page editor (Elementor-like interface)
     */
    public function index()
    {
        $content = ContentHelper::getAboutContent();
        return view('dashboard.about.index', compact('content'));
    }
    
    /**
     * Get about page content (API)
     */
    public function getContent()
    {
        $content = ContentHelper::getAboutContent();
        return response()->json($content);
    }
    
    /**
     * Update about page content
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
            ContentHelper::saveAboutContent($request->input('content'));
            
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
     * Preview about page with current changes
     */
    public function preview()
    {
        $content = ContentHelper::getAboutContent();
        return view('about', ['content' => $content, 'editor_mode' => false]);
    }
}



