<?php

namespace App\Http\Controllers;

use App\Helpers\ContentHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactContentController extends Controller
{
    /**
     * Display the contact page editor (Elementor-like interface)
     */
    public function index()
    {
        $content = ContentHelper::getContactContent();
        return view('dashboard.contact.index', compact('content'));
    }
    
    /**
     * Get contact page content (API)
     */
    public function getContent()
    {
        $content = ContentHelper::getContactContent();
        return response()->json($content);
    }
    
    /**
     * Update contact page content
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
            ContentHelper::saveContactContent($request->input('content'));
            
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
     * Preview contact page with current changes
     */
    public function preview()
    {
        $content = ContentHelper::getContactContent();
        return view('contact', ['content' => $content, 'editor_mode' => false]);
    }
}



