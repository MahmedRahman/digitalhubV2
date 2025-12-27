<?php

namespace App\Http\Controllers;

use App\Helpers\ContentHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of courses
     */
    public function index()
    {
        $courses = ContentHelper::getCourses();
        // Ensure courses is always an array
        if (!is_array($courses)) {
            $courses = [];
        }
        return view('dashboard.courses.index', compact('courses'));
    }
    
    /**
     * Show the form for creating a new course
     */
    public function create()
    {
        return view('dashboard.courses.create');
    }
    
    /**
     * Store a newly created course
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'short_description' => 'required|string|max:500',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:500',
            'level' => 'required|string|in:مبتدئ,متوسط,متقدم',
            'duration' => 'required|string|max:100',
            'lessons_count' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'currency' => 'nullable|string|max:50',
            'category' => 'nullable|string|max:100',
            'category_name' => 'nullable|string|max:255',
            'status' => 'required|string|in:active,inactive',
            'course_overview' => 'nullable|array',
            'course_overview.*' => 'string|max:1000',
            'learning_outcomes' => 'nullable|array',
            'learning_outcomes.*' => 'string|max:500',
            'who_is_this_for' => 'nullable|array',
            'who_is_this_for.*' => 'string|max:500',
            'course_outline' => 'nullable|array',
            'course_outline.*.title' => 'required_with:course_outline|string|max:255',
            'course_outline.*.lessons' => 'nullable|array',
            'course_outline.*.lessons.*.title' => 'required|string|max:255',
            'course_outline.*.lessons.*.duration' => 'nullable|string|max:50',
            'trainers' => 'nullable|array',
            'trainers.*.name' => 'required|string|max:255',
            'trainers.*.description' => 'required|string|max:1000',
            'reviews' => 'nullable|array',
            'reviews.*.name' => 'required|string|max:255',
            'reviews.*.text' => 'required|string|max:1000',
            'reviews.*.rating' => 'required|integer|min:1|max:5',
            'final_cta_block' => 'nullable|array',
            'final_cta_block.headline' => 'nullable|string|max:255',
            'final_cta_block.text' => 'nullable|string|max:500',
            'final_cta_block.button_text' => 'nullable|string|max:100',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        try {
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('courses', 'public');
            }
            
            // Prepare course data
            $courseData = [
                'title' => $request->input('title'),
                'slug' => $request->input('slug') ?: \Str::slug($request->input('title')),
                'short_description' => $request->input('short_description'),
                'hero_title' => $request->input('hero_title') ?: $request->input('title'),
                'hero_subtitle' => $request->input('hero_subtitle') ?: $request->input('short_description'),
                'level' => $request->input('level'),
                'level_badge' => $request->input('level') === 'مبتدئ' ? 'Beginner' : ($request->input('level') === 'متوسط' ? 'Intermediate' : 'Advanced'),
                'duration' => $request->input('duration'),
                'lessons_count' => $request->input('lessons_count'),
                'price' => $request->input('price'),
                'currency' => $request->input('currency') ?: 'جنيه',
                'category' => $request->input('category') ?: 'marketing',
                'category_name' => $request->input('category_name') ?: 'التسويق الرقمي',
                'primary_cta_text' => 'اعرف التفاصيل',
                'secondary_cta_text' => 'محتوى الكورس',
                'image' => $imagePath,
                'stats_bar' => [
                    'duration' => $request->input('duration') . ' تدريب',
                    'lessons' => $request->input('lessons_count') . ' درس عملي',
                    'level' => $request->input('level'),
                ],
                'course_overview' => $request->input('course_overview') ?: [],
                'learning_outcomes' => $request->input('learning_outcomes') ?: [],
                'who_is_this_for' => $request->input('who_is_this_for') ?: [],
                'course_outline' => $request->input('course_outline') ?: [],
                'trainers' => $request->input('trainers') ?: [],
                'reviews' => $request->input('reviews') ?: [],
                'final_cta_block' => $request->input('final_cta_block') ?: [
                    'headline' => 'ابدأ رحلتك في التعلم',
                    'text' => 'انضم إلى الكورس وابدأ في بناء مهاراتك العملية.',
                    'button_text' => 'سجل الآن',
                ],
                'download_link' => $request->input('download_link'),
                'status' => $request->input('status'),
            ];
            
            $id = ContentHelper::addCourse($courseData);
            
            return redirect()->route('dashboard.courses.index')
                ->with('success', 'تم إضافة الدورة بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء إضافة الدورة: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Display the specified course
     */
    public function show($id)
    {
        $course = ContentHelper::getCourse($id);
        
        if (!$course) {
            return redirect()->route('dashboard.courses.index')
                ->with('error', 'الدورة غير موجودة');
        }
        
        return view('dashboard.courses.show', compact('course'));
    }
    
    /**
     * Show the form for editing the specified course
     */
    public function edit($id)
    {
        $course = ContentHelper::getCourse($id);
        
        if (!$course) {
            return redirect()->route('dashboard.courses.index')
                ->with('error', 'الدورة غير موجودة');
        }
        
        return view('dashboard.courses.edit', compact('course'));
    }
    
    /**
     * Update the specified course
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'short_description' => 'required|string|max:500',
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string|max:500',
            'level' => 'required|string|in:مبتدئ,متوسط,متقدم',
            'duration' => 'required|string|max:100',
            'lessons_count' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'currency' => 'nullable|string|max:50',
            'category' => 'nullable|string|max:100',
            'category_name' => 'nullable|string|max:255',
            'status' => 'required|string|in:active,inactive',
            'course_overview' => 'nullable|array',
            'course_overview.*' => 'string|max:1000',
            'learning_outcomes' => 'nullable|array',
            'learning_outcomes.*' => 'string|max:500',
            'who_is_this_for' => 'nullable|array',
            'who_is_this_for.*' => 'string|max:500',
            'course_outline' => 'nullable|array',
            'course_outline.*.title' => 'required_with:course_outline|string|max:255',
            'course_outline.*.lessons' => 'nullable|array',
            'course_outline.*.lessons.*.title' => 'required|string|max:255',
            'course_outline.*.lessons.*.duration' => 'nullable|string|max:50',
            'trainers' => 'nullable|array',
            'trainers.*.name' => 'required|string|max:255',
            'trainers.*.description' => 'required|string|max:1000',
            'reviews' => 'nullable|array',
            'reviews.*.name' => 'required|string|max:255',
            'reviews.*.text' => 'required|string|max:1000',
            'reviews.*.rating' => 'required|integer|min:1|max:5',
            'final_cta_block' => 'nullable|array',
            'final_cta_block.headline' => 'nullable|string|max:255',
            'final_cta_block.text' => 'nullable|string|max:500',
            'final_cta_block.button_text' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'download_link' => 'nullable|url|max:500',
        ], [
            'title.required' => 'اسم الدورة مطلوب',
            'title.max' => 'اسم الدورة يجب ألا يتجاوز 255 حرف',
            'short_description.required' => 'الوصف المختصر مطلوب',
            'short_description.max' => 'الوصف المختصر يجب ألا يتجاوز 500 حرف',
            'level.required' => 'المستوى مطلوب',
            'level.in' => 'المستوى يجب أن يكون: مبتدئ، متوسط، أو متقدم',
            'duration.required' => 'المدة مطلوبة',
            'duration.max' => 'المدة يجب ألا تتجاوز 100 حرف',
            'lessons_count.required' => 'عدد الدروس مطلوب',
            'lessons_count.integer' => 'عدد الدروس يجب أن يكون رقماً',
            'lessons_count.min' => 'عدد الدروس يجب أن يكون على الأقل 1',
            'price.required' => 'السعر مطلوب',
            'price.numeric' => 'السعر يجب أن يكون رقماً',
            'price.min' => 'السعر يجب أن يكون أكبر من أو يساوي 0',
            'status.required' => 'الحالة مطلوبة',
            'status.in' => 'الحالة يجب أن تكون: نشط أو غير نشط',
            'trainers.*.name.required' => 'اسم المدرب مطلوب',
            'trainers.*.description.required' => 'وصف المدرب مطلوب',
            'course_outline.*.title.required_with' => 'اسم القسم مطلوب',
            'course_outline.*.lessons.*.title.required' => 'اسم الدرس مطلوب',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        try {
            $existingCourse = ContentHelper::getCourse($id);
            
            // Handle image upload
            $imagePath = $existingCourse['image'] ?? null;
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
                // Upload new image
                $image = $request->file('image');
                $imagePath = $image->store('courses', 'public');
            }
            
            // Prepare course data
            $courseData = [
                'title' => $request->input('title'),
                'slug' => $request->input('slug') ?: \Str::slug($request->input('title')),
                'short_description' => $request->input('short_description'),
                'hero_title' => $request->input('hero_title') ?: $request->input('title'),
                'hero_subtitle' => $request->input('hero_subtitle') ?: $request->input('short_description'),
                'level' => $request->input('level'),
                'level_badge' => $request->input('level') === 'مبتدئ' ? 'Beginner' : ($request->input('level') === 'متوسط' ? 'Intermediate' : 'Advanced'),
                'duration' => $request->input('duration'),
                'lessons_count' => $request->input('lessons_count'),
                'price' => $request->input('price'),
                'currency' => $request->input('currency') ?: ($existingCourse['currency'] ?? 'جنيه'),
                'category' => $request->input('category') ?: ($existingCourse['category'] ?? 'marketing'),
                'category_name' => $request->input('category_name') ?: ($existingCourse['category_name'] ?? 'التسويق الرقمي'),
                'primary_cta_text' => $existingCourse['primary_cta_text'] ?? 'اعرف التفاصيل',
                'secondary_cta_text' => $existingCourse['secondary_cta_text'] ?? 'محتوى الكورس',
                'image' => $imagePath,
                'stats_bar' => [
                    'duration' => $request->input('duration') . ' تدريب',
                    'lessons' => $request->input('lessons_count') . ' درس عملي',
                    'level' => $request->input('level'),
                ],
                'course_overview' => $request->input('course_overview') ?: [],
                'learning_outcomes' => $request->input('learning_outcomes') ?: [],
                'who_is_this_for' => $request->input('who_is_this_for') ?: [],
                'course_outline' => $request->input('course_outline') ?: [],
                'trainers' => $request->input('trainers') ?: [],
                'reviews' => $request->input('reviews') ?: ($existingCourse['reviews'] ?? []),
                'final_cta_block' => $request->input('final_cta_block') ?: ($existingCourse['final_cta_block'] ?? [
                    'headline' => 'ابدأ رحلتك في التعلم',
                    'text' => 'انضم إلى الكورس وابدأ في بناء مهاراتك العملية.',
                    'button_text' => 'سجل الآن',
                ]),
                'download_link' => $request->input('download_link') ?: ($existingCourse['download_link'] ?? null),
                'status' => $request->input('status'),
            ];
            
            ContentHelper::updateCourse($id, $courseData);
            
            return redirect()->route('dashboard.courses.index')
                ->with('success', 'تم تحديث الدورة بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء تحديث الدورة: ' . $e->getMessage())
                ->withInput();
        }
    }
    
    /**
     * Remove the specified course
     */
    public function destroy($id)
    {
        try {
            ContentHelper::deleteCourse($id);
            
            return redirect()->route('dashboard.courses.index')
                ->with('success', 'تم حذف الدورة بنجاح');
        } catch (\Exception $e) {
            return back()->with('error', 'حدث خطأ أثناء حذف الدورة: ' . $e->getMessage());
        }
    }
}

