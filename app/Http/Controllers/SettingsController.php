<?php

namespace App\Http\Controllers;

use App\Helpers\ContentHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display the settings page
     */
    public function index()
    {
        $settings = ContentHelper::getSiteSettings();
        return view('dashboard.settings', compact('settings'));
    }
    
    /**
     * Get site settings (API)
     */
    public function getSettings()
    {
        $settings = ContentHelper::getSiteSettings();
        return response()->json($settings);
    }
    
    /**
     * Update site settings
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'site_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'address' => 'required|string|max:500',
            'social_media' => 'required|array',
            'social_media.youtube' => 'nullable|url|max:255',
            'social_media.facebook' => 'nullable|url|max:255',
            'social_media.instagram' => 'nullable|url|max:255',
            'social_media.linkedin' => 'nullable|url|max:255',
            'social_media.twitter' => 'nullable|url|max:255',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        try {
            $settings = [
                'site_name' => $request->input('site_name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'whatsapp' => $request->input('whatsapp'),
                'address' => $request->input('address'),
                'social_media' => $request->input('social_media')
            ];
            
            ContentHelper::saveSiteSettings($settings);
            
            return back()->with('success', 'تم حفظ الإعدادات بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء الحفظ: ' . $e->getMessage())->withInput();
        }
    }
}



