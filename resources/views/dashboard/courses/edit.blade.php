@extends('layouts.dashboard')

@section('title', 'تعديل الدورة')
@section('page-title', 'تعديل الدورة')
@section('page-description', 'عدل بيانات الدورة التدريبية')

@push('styles')
<style>
    .form-tab {
        display: none;
    }
    .form-tab.active {
        display: block;
    }
    .tab-button {
        padding: 12px 24px;
        border: 2px solid #E5E7EB;
        background: white;
        color: #6B6F73;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .tab-button.active {
        background: #04c2eb;
        color: white;
        border-color: #04c2eb;
    }
    .tab-button:hover:not(.active) {
        border-color: #04c2eb;
        color: #04c2eb;
    }
    .dynamic-item {
        background: #F5F6F7;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 12px;
        border: 2px solid #E5E7EB;
    }
    .remove-btn {
        background: #EF4444;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }
    .add-btn {
        background: #04c2eb;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }
</style>
@endpush

@section('content')
    <div class="max-w-6xl">
        @if(session('success'))
            <div class="bg-green-50 border-2 border-green-200 rounded-xl p-4 mb-6">
                <p class="text-green-800">{{ session('success') }}</p>
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4 mb-6">
                <p class="text-red-800">{{ session('error') }}</p>
            </div>
        @endif
        
        <form method="POST" action="{{ route('dashboard.courses.update', $course['id']) }}" id="course-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Tabs Navigation -->
            <div class="bg-white rounded-xl p-4 border-2 mb-6" style="border-color: #111111;">
                <div class="flex flex-wrap gap-3">
                    <button type="button" class="tab-button active" data-tab="basic">المعلومات الأساسية</button>
                    <button type="button" class="tab-button" data-tab="overview">نظرة عامة</button>
                    <button type="button" class="tab-button" data-tab="outcomes">ما ستتعلمه</button>
                    <button type="button" class="tab-button" data-tab="outline">محتوى الكورس</button>
                    <button type="button" class="tab-button" data-tab="target">هذا الكورس مناسب لـ</button>
                    <button type="button" class="tab-button" data-tab="trainers">المدربين</button>
                    <button type="button" class="tab-button" data-tab="reviews">آراء الطلاب</button>
                    <button type="button" class="tab-button" data-tab="cta">دعوة للعمل</button>
                </div>
            </div>
            
            <!-- Tab 1: Basic Information -->
            <div class="form-tab active" id="tab-basic">
                <div class="bg-white rounded-xl p-6 border-2 mb-6" style="border-color: #111111;">
                    <h2 class="text-xl font-heading font-bold text-textDark mb-6">المعلومات الأساسية</h2>
                    
                    <div class="space-y-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-textDark mb-2">
                                اسم الدورة <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="title"
                                name="title" 
                                value="{{ old('title', $course['title'] ?? '') }}" 
                                required
                                placeholder="مثال: دبلومة الميديا بير"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                style="border-color: #E5E7EB;"
                            >
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Slug -->
                        <div>
                            <label for="slug" class="block text-sm font-medium text-textDark mb-2">
                                الرابط (Slug)
                            </label>
                            <input 
                                type="text" 
                                id="slug"
                                name="slug" 
                                value="{{ old('slug', $course['slug'] ?? '') }}" 
                                placeholder="سيتم إنشاؤه تلقائياً من اسم الدورة"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                style="border-color: #E5E7EB;"
                            >
                            <p class="mt-1 text-xs text-textMuted">مثال: media-buyer-diploma</p>
                        </div>
                        
                        <!-- Short Description -->
                        <div>
                            <label for="short_description" class="block text-sm font-medium text-textDark mb-2">
                                الوصف المختصر <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="short_description"
                                name="short_description" 
                                rows="3"
                                required
                                placeholder="وصف مختصر يظهر في بطاقة الدورة..."
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors resize-none" 
                                style="border-color: #E5E7EB;"
                            >{{ old('short_description', $course['short_description'] ?? '') }}</textarea>
                            @error('short_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Hero Title & Subtitle -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="hero_title" class="block text-sm font-medium text-textDark mb-2">
                                    عنوان الصفحة
                                </label>
                                <input 
                                    type="text" 
                                    id="hero_title"
                                    name="hero_title" 
                                    value="{{ old('hero_title', $course['hero_title'] ?? $course['title'] ?? '') }}" 
                                    placeholder="سيتم استخدام اسم الدورة تلقائياً"
                                    class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                    style="border-color: #E5E7EB;"
                                >
                            </div>
                            <div>
                                <label for="hero_subtitle" class="block text-sm font-medium text-textDark mb-2">
                                    العنوان الفرعي
                                </label>
                                <input 
                                    type="text" 
                                    id="hero_subtitle"
                                    name="hero_subtitle" 
                                    value="{{ old('hero_subtitle', $course['hero_subtitle'] ?? $course['short_description'] ?? '') }}" 
                                    placeholder="سيتم استخدام الوصف المختصر تلقائياً"
                                    class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                    style="border-color: #E5E7EB;"
                                >
                            </div>
                        </div>
                        
                        <!-- Level, Duration, Lessons -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="level" class="block text-sm font-medium text-textDark mb-2">
                                    المستوى <span class="text-red-500">*</span>
                                </label>
                                <select 
                                    id="level"
                                    name="level" 
                                    required
                                    class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                    style="border-color: #E5E7EB;"
                                >
                                    <option value="">اختر المستوى</option>
                                    <option value="مبتدئ" {{ old('level', $course['level'] ?? '') == 'مبتدئ' ? 'selected' : '' }}>مبتدئ</option>
                                    <option value="متوسط" {{ old('level', $course['level'] ?? '') == 'متوسط' ? 'selected' : '' }}>متوسط</option>
                                    <option value="متقدم" {{ old('level', $course['level'] ?? '') == 'متقدم' ? 'selected' : '' }}>متقدم</option>
                                </select>
                                @error('level')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="duration" class="block text-sm font-medium text-textDark mb-2">
                                    المدة <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="duration"
                                    name="duration" 
                                    value="{{ old('duration', $course['duration'] ?? '') }}" 
                                    required
                                    placeholder="مثال: 80 ساعة"
                                    class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                    style="border-color: #E5E7EB;"
                                >
                                @error('duration')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="lessons_count" class="block text-sm font-medium text-textDark mb-2">
                                    عدد الدروس <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="number" 
                                    id="lessons_count"
                                    name="lessons_count" 
                                    value="{{ old('lessons_count', $course['lessons_count'] ?? '') }}" 
                                    required
                                    min="1"
                                    placeholder="مثال: 45"
                                    class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                    style="border-color: #E5E7EB;"
                                >
                                @error('lessons_count')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Course Image -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-textDark mb-2">
                                صورة الدورة
                            </label>
                            <div class="flex items-center gap-4">
                                @if(isset($course['image']) && $course['image'])
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('storage/' . $course['image']) }}" alt="Current Image" class="w-32 h-32 object-cover rounded-lg border-2" style="border-color: #E5E7EB;">
                                        <p class="text-xs text-textMuted mt-2 text-center">الصورة الحالية</p>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <input 
                                        type="file" 
                                        id="image"
                                        name="image" 
                                        accept="image/*"
                                        onchange="previewImage(this)"
                                        class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                        style="border-color: #E5E7EB;"
                                    >
                                    <p class="mt-1 text-xs text-textMuted">الصيغ المدعومة: JPG, PNG, GIF (الحد الأقصى: 5MB)</p>
                                    <p class="mt-1 text-xs text-textMuted">اتركه فارغاً للاحتفاظ بالصورة الحالية</p>
                                    <p class="mt-1 text-xs text-blue-600 font-medium">📐 <strong>ملاحظة:</strong> المقاسات المناسبة للصور: 1200x675 بكسل (نسبة 16:9) لضمان ظهورها بشكل سليم على الموقع</p>
                                </div>
                                <div id="image-preview" class="hidden">
                                    <img id="preview-img" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border-2" style="border-color: #E5E7EB;">
                                    <p class="text-xs text-textMuted mt-2 text-center">معاينة جديدة</p>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600 font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <!-- Price, Currency, Category -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="price" class="block text-sm font-medium text-textDark mb-2">
                                    السعر <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="number" 
                                    id="price"
                                    name="price" 
                                    value="{{ old('price', $course['price'] ?? '') }}" 
                                    required
                                    min="0"
                                    step="0.01"
                                    placeholder="مثال: 5500"
                                    class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                    style="border-color: #E5E7EB;"
                                >
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="currency" class="block text-sm font-medium text-textDark mb-2">
                                    العملة
                                </label>
                                <input 
                                    type="text" 
                                    id="currency"
                                    name="currency" 
                                    value="{{ old('currency', $course['currency'] ?? 'جنيه') }}" 
                                    placeholder="مثال: جنيه"
                                    class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                    style="border-color: #E5E7EB;"
                                >
                            </div>
                            <div>
                                <label for="category_name" class="block text-sm font-medium text-textDark mb-2">
                                    التصنيف
                                </label>
                                <input 
                                    type="text" 
                                    id="category_name"
                                    name="category_name" 
                                    value="{{ old('category_name', $course['category_name'] ?? '') }}" 
                                    placeholder="مثال: الإعلانات المدفوعة"
                                    class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                    style="border-color: #E5E7EB;"
                                >
                            </div>
                        </div>
                        
                        <!-- Download Link -->
                        <div>
                            <label for="download_link" class="block text-sm font-medium text-textDark mb-2">
                                رابط تحميل المحتوى
                            </label>
                            <input 
                                type="url" 
                                id="download_link"
                                name="download_link" 
                                value="{{ old('download_link', $course['download_link'] ?? '') }}" 
                                placeholder="مثال: https://drive.google.com/file/..."
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                style="border-color: #E5E7EB;"
                            >
                            <p class="mt-1 text-xs text-textMuted">يمكن أن يكون رابط Google Drive، Dropbox، أو أي رابط آخر لتحميل المحتوى</p>
                            @error('download_link')
                                <p class="mt-1 text-sm text-red-600 font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-textDark mb-2">
                                الحالة <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="status"
                                name="status" 
                                required
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                style="border-color: #E5E7EB;"
                            >
                                <option value="">اختر الحالة</option>
                                <option value="active" {{ old('status', $course['status'] ?? '') == 'active' ? 'selected' : '' }}>نشط</option>
                                <option value="inactive" {{ old('status', $course['status'] ?? '') == 'inactive' ? 'selected' : '' }}>غير نشط</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tab 2: Course Overview -->
            <div class="form-tab" id="tab-overview">
                <div class="bg-white rounded-xl p-6 border-2 mb-6" style="border-color: #111111;">
                    <h2 class="text-xl font-heading font-bold text-textDark mb-6">نظرة عامة على الدورة</h2>
                    <p class="text-sm text-textMuted mb-4">أضف فقرات وصفية عن الدورة (يمكن إضافة أكثر من فقرة)</p>
                    
                    <div id="overview-container">
                        @php
                            $overviewItems = old('course_overview', $course['course_overview'] ?? []);
                        @endphp
                        @if(is_array($overviewItems) && count($overviewItems) > 0)
                            @foreach($overviewItems as $index => $overview)
                                <div class="dynamic-item">
                                    <textarea 
                                        name="course_overview[]" 
                                        rows="3"
                                        placeholder="اكتب فقرة وصفية عن الدورة..."
                                        class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors resize-none" 
                                        style="border-color: #E5E7EB;"
                                    >{{ $overview }}</textarea>
                                    <button type="button" class="remove-btn mt-2" onclick="this.parentElement.remove()">حذف</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="add-btn" onclick="addOverviewItem()">+ إضافة فقرة</button>
                </div>
            </div>
            
            <!-- Tab 3: Learning Outcomes -->
            <div class="form-tab" id="tab-outcomes">
                <div class="bg-white rounded-xl p-6 border-2 mb-6" style="border-color: #111111;">
                    <h2 class="text-xl font-heading font-bold text-textDark mb-6">ما ستتعلمه</h2>
                    <p class="text-sm text-textMuted mb-4">أضف نقاط التعلم (يمكن إضافة أكثر من نقطة)</p>
                    
                    <div id="outcomes-container">
                        @php
                            $outcomesItems = old('learning_outcomes', $course['learning_outcomes'] ?? []);
                        @endphp
                        @if(is_array($outcomesItems) && count($outcomesItems) > 0)
                            @foreach($outcomesItems as $index => $outcome)
                                <div class="dynamic-item">
                                    <input 
                                        type="text" 
                                        name="learning_outcomes[]" 
                                        value="{{ $outcome }}"
                                        placeholder="مثال: إدارة حملات TikTok Ads من الصفر"
                                        class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                        style="border-color: #E5E7EB;"
                                    >
                                    <button type="button" class="remove-btn mt-2" onclick="this.parentElement.remove()">حذف</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="add-btn" onclick="addOutcomeItem()">+ إضافة نقطة</button>
                </div>
            </div>
            
            <!-- Tab 4: Course Outline -->
            <div class="form-tab" id="tab-outline">
                <div class="bg-white rounded-xl p-6 border-2 mb-6" style="border-color: #111111;">
                    <h2 class="text-xl font-heading font-bold text-textDark mb-6">محتوى الكورس</h2>
                    <p class="text-sm text-textMuted mb-4">أضف أقسام الكورس والدروس</p>
                    
                    <div id="outline-container">
                        @php
                            $outlineItems = old('course_outline', $course['course_outline'] ?? []);
                            $maxSectionIndex = is_array($outlineItems) ? count($outlineItems) : 0;
                        @endphp
                        @if(is_array($outlineItems) && count($outlineItems) > 0)
                            @foreach($outlineItems as $sectionIndex => $section)
                                <div class="dynamic-item" style="background: #FFFFFF; border: 2px solid #04c2eb;">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-textDark mb-2">اسم القسم</label>
                                        <input 
                                            type="text" 
                                            name="course_outline[{{ $sectionIndex }}][title]" 
                                            value="{{ $section['title'] ?? '' }}"
                                            placeholder="مثال: مقدمة في الميديا بيرينج"
                                            class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                            style="border-color: #E5E7EB;"
                                        >
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-textDark mb-2">الدروس</label>
                                        <div id="lessons-{{ $sectionIndex }}">
                                            @if(isset($section['lessons']) && is_array($section['lessons']))
                                                @foreach($section['lessons'] as $lessonIndex => $lesson)
                                                    <div class="flex gap-2 mb-2">
                                                        <input 
                                                            type="text" 
                                                            name="course_outline[{{ $sectionIndex }}][lessons][{{ $lessonIndex }}][title]" 
                                                            value="{{ $lesson['title'] ?? '' }}"
                                                            placeholder="اسم الدرس"
                                                            class="flex-1 px-4 py-2 border-2 rounded-lg" 
                                                            style="border-color: #E5E7EB;"
                                                        >
                                                        <input 
                                                            type="text" 
                                                            name="course_outline[{{ $sectionIndex }}][lessons][{{ $lessonIndex }}][duration]" 
                                                            value="{{ $lesson['duration'] ?? '' }}"
                                                            placeholder="المدة"
                                                            class="w-32 px-4 py-2 border-2 rounded-lg" 
                                                            style="border-color: #E5E7EB;"
                                                        >
                                                        <button type="button" class="remove-btn" onclick="this.parentElement.remove()">حذف</button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <button type="button" class="add-btn" onclick="addLesson({{ $sectionIndex }})">+ إضافة درس</button>
                                    </div>
                                    <button type="button" class="remove-btn" onclick="this.parentElement.remove()">حذف القسم</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="add-btn" onclick="addSection()">+ إضافة قسم</button>
                </div>
            </div>
            
            <!-- Tab 5: Who is this for -->
            <div class="form-tab" id="tab-target">
                <div class="bg-white rounded-xl p-6 border-2 mb-6" style="border-color: #111111;">
                    <h2 class="text-xl font-heading font-bold text-textDark mb-6">هذا الكورس مناسب لـ</h2>
                    <p class="text-sm text-textMuted mb-4">أضف الفئات المستهدفة (يمكن إضافة أكثر من فئة)</p>
                    
                    <div id="target-container">
                        @php
                            $targetItems = old('who_is_this_for', $course['who_is_this_for'] ?? []);
                        @endphp
                        @if(is_array($targetItems) && count($targetItems) > 0)
                            @foreach($targetItems as $index => $target)
                                <div class="dynamic-item">
                                    <input 
                                        type="text" 
                                        name="who_is_this_for[]" 
                                        value="{{ $target }}"
                                        placeholder="مثال: من يريد العمل كميديا بير"
                                        class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                        style="border-color: #E5E7EB;"
                                    >
                                    <button type="button" class="remove-btn mt-2" onclick="this.parentElement.remove()">حذف</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="add-btn" onclick="addTargetItem()">+ إضافة فئة</button>
                </div>
            </div>
            
            <!-- Tab 6: Trainers -->
            <div class="form-tab" id="tab-trainers">
                <div class="bg-white rounded-xl p-6 border-2 mb-6" style="border-color: #111111;">
                    <h2 class="text-xl font-heading font-bold text-textDark mb-6">مدربو الدورة</h2>
                    <p class="text-sm text-textMuted mb-4">أضف المدربين الذين سيقومون بتدريس هذه الدورة (يمكن إضافة أكثر من مدرب)</p>
                    
                    <div id="trainers-container">
                        @php
                            $trainersItems = old('trainers', $course['trainers'] ?? []);
                        @endphp
                        @if(is_array($trainersItems) && count($trainersItems) > 0)
                            @foreach($trainersItems as $index => $trainer)
                                <div class="dynamic-item" style="background: #FFFFFF; border: 2px solid #04c2eb;">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-textDark mb-2">اسم المدرب</label>
                                        <input 
                                            type="text" 
                                            name="trainers[{{ $index }}][name]" 
                                            value="{{ $trainer['name'] ?? '' }}"
                                            placeholder="مثال: أحمد ماهر"
                                            class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                            style="border-color: #E5E7EB;"
                                        >
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-textDark mb-2">الوصف</label>
                                        <textarea 
                                            name="trainers[{{ $index }}][description]" 
                                            rows="4"
                                            placeholder="اكتب وصفاً عن المدرب وخبراته..."
                                            class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors resize-none" 
                                            style="border-color: #E5E7EB;"
                                        >{{ $trainer['description'] ?? '' }}</textarea>
                                    </div>
                                    <button type="button" class="remove-btn" onclick="this.parentElement.remove()">حذف المدرب</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="add-btn" onclick="addTrainer()">+ إضافة مدرب</button>
                </div>
            </div>
            
            <!-- Tab 7: Student Reviews -->
            <div class="form-tab" id="tab-reviews">
                <div class="bg-white rounded-xl p-6 border-2 mb-6" style="border-color: #111111;">
                    <h2 class="text-xl font-heading font-bold text-textDark mb-6">آراء الطلاب</h2>
                    <p class="text-textMuted mb-6">أضف آراء وتقييمات الطلاب للدورة</p>
                    
                    <div id="reviews-container" class="space-y-4">
                        @if(old('reviews') && is_array(old('reviews')))
                            @foreach(old('reviews') as $index => $review)
                                <div class="dynamic-item" style="background: #FFFFFF; border: 2px solid #04c2eb;">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-textDark mb-2">اسم الطالب</label>
                                        <input 
                                            type="text" 
                                            name="reviews[{{ $index }}][name]" 
                                            value="{{ $review['name'] ?? '' }}"
                                            placeholder="مثال: محمد أحمد"
                                            class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                            style="border-color: #E5E7EB;"
                                        >
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-textDark mb-2">نص الرأي</label>
                                        <textarea 
                                            name="reviews[{{ $index }}][text]" 
                                            rows="4"
                                            placeholder="اكتب رأي الطالب في الدورة..."
                                            class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors resize-none" 
                                            style="border-color: #E5E7EB;"
                                        >{{ $review['text'] ?? '' }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-textDark mb-2">التقييم (من 5)</label>
                                        <select 
                                            name="reviews[{{ $index }}][rating]" 
                                            class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                            style="border-color: #E5E7EB;"
                                        >
                                            <option value="5" {{ ($review['rating'] ?? 5) == 5 ? 'selected' : '' }}>5 نجوم</option>
                                            <option value="4" {{ ($review['rating'] ?? 5) == 4 ? 'selected' : '' }}>4 نجوم</option>
                                            <option value="3" {{ ($review['rating'] ?? 5) == 3 ? 'selected' : '' }}>3 نجوم</option>
                                            <option value="2" {{ ($review['rating'] ?? 5) == 2 ? 'selected' : '' }}>2 نجوم</option>
                                            <option value="1" {{ ($review['rating'] ?? 5) == 1 ? 'selected' : '' }}>1 نجمة</option>
                                        </select>
                                    </div>
                                    <button type="button" class="remove-btn" onclick="this.parentElement.remove()">حذف الرأي</button>
                                </div>
                            @endforeach
                        @elseif(isset($course['reviews']) && is_array($course['reviews']) && count($course['reviews']) > 0)
                            @foreach($course['reviews'] as $index => $review)
                                <div class="dynamic-item" style="background: #FFFFFF; border: 2px solid #04c2eb;">
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-textDark mb-2">اسم الطالب</label>
                                        <input 
                                            type="text" 
                                            name="reviews[{{ $index }}][name]" 
                                            value="{{ $review['name'] ?? '' }}"
                                            placeholder="مثال: محمد أحمد"
                                            class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                            style="border-color: #E5E7EB;"
                                        >
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-textDark mb-2">نص الرأي</label>
                                        <textarea 
                                            name="reviews[{{ $index }}][text]" 
                                            rows="4"
                                            placeholder="اكتب رأي الطالب في الدورة..."
                                            class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors resize-none" 
                                            style="border-color: #E5E7EB;"
                                        >{{ $review['text'] ?? '' }}</textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-textDark mb-2">التقييم (من 5)</label>
                                        <select 
                                            name="reviews[{{ $index }}][rating]" 
                                            class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                            style="border-color: #E5E7EB;"
                                        >
                                            <option value="5" {{ ($review['rating'] ?? 5) == 5 ? 'selected' : '' }}>5 نجوم</option>
                                            <option value="4" {{ ($review['rating'] ?? 5) == 4 ? 'selected' : '' }}>4 نجوم</option>
                                            <option value="3" {{ ($review['rating'] ?? 5) == 3 ? 'selected' : '' }}>3 نجوم</option>
                                            <option value="2" {{ ($review['rating'] ?? 5) == 2 ? 'selected' : '' }}>2 نجوم</option>
                                            <option value="1" {{ ($review['rating'] ?? 5) == 1 ? 'selected' : '' }}>1 نجمة</option>
                                        </select>
                                    </div>
                                    <button type="button" class="remove-btn" onclick="this.parentElement.remove()">حذف الرأي</button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="add-btn" onclick="addReview()">+ إضافة رأي</button>
                </div>
            </div>
            
            <!-- Tab 8: Final CTA -->
            <div class="form-tab" id="tab-cta">
                <div class="bg-white rounded-xl p-6 border-2 mb-6" style="border-color: #111111;">
                    <h2 class="text-xl font-heading font-bold text-textDark mb-6">دعوة للعمل (CTA)</h2>
                    
                    <div class="space-y-6">
                        <div>
                            <label for="cta_headline" class="block text-sm font-medium text-textDark mb-2">
                                العنوان
                            </label>
                            <input 
                                type="text" 
                                id="cta_headline"
                                name="final_cta_block[headline]" 
                                value="{{ old('final_cta_block.headline', $course['final_cta_block']['headline'] ?? 'ابدأ رحلتك في التعلم') }}" 
                                placeholder="مثال: ابدأ رحلتك كميديا بير محترف"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                style="border-color: #E5E7EB;"
                            >
                        </div>
                        <div>
                            <label for="cta_text" class="block text-sm font-medium text-textDark mb-2">
                                النص
                            </label>
                            <textarea 
                                id="cta_text"
                                name="final_cta_block[text]" 
                                rows="3"
                                placeholder="مثال: انضم إلى الكورس وابدأ في بناء مهاراتك العملية..."
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors resize-none" 
                                style="border-color: #E5E7EB;"
                            >{{ old('final_cta_block.text', $course['final_cta_block']['text'] ?? 'انضم إلى الكورس وابدأ في بناء مهاراتك العملية.') }}</textarea>
                        </div>
                        <div>
                            <label for="cta_button" class="block text-sm font-medium text-textDark mb-2">
                                نص الزر
                            </label>
                            <input 
                                type="text" 
                                id="cta_button"
                                name="final_cta_block[button_text]" 
                                value="{{ old('final_cta_block.button_text', $course['final_cta_block']['button_text'] ?? 'سجل الآن') }}" 
                                placeholder="مثال: سجل الآن"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                style="border-color: #E5E7EB;"
                            >
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div class="bg-white rounded-xl p-6 border-2" style="border-color: #111111;">
                <div class="flex items-center gap-4">
                    <button type="submit" class="btn-primary px-8 py-3">
                        حفظ التعديلات
                    </button>
                    <a href="{{ route('dashboard.courses.index') }}" class="px-8 py-3 rounded-lg font-medium border-2 transition-colors" style="border-color: #E5E7EB; color: #6B6F73;">
                        إلغاء
                    </a>
                </div>
            </div>
        </form>
    </div>

@push('scripts')
<script>
    // Tab switching
    document.querySelectorAll('.tab-button').forEach(button => {
        button.addEventListener('click', function() {
            const tabName = this.dataset.tab;
            
            // Remove active class from all tabs and buttons
            document.querySelectorAll('.form-tab').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
            
            // Add active class to selected tab and button
            document.getElementById('tab-' + tabName).classList.add('active');
            this.classList.add('active');
        });
    });
    
    // Dynamic items
    let sectionIndex = {{ $maxSectionIndex ?? 0 }};
    
    function addOverviewItem() {
        const container = document.getElementById('overview-container');
        const div = document.createElement('div');
        div.className = 'dynamic-item';
        div.innerHTML = `
            <textarea name="course_overview[]" rows="3" placeholder="اكتب فقرة وصفية عن الدورة..." class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors resize-none" style="border-color: #E5E7EB;"></textarea>
            <button type="button" class="remove-btn mt-2" onclick="this.parentElement.remove()">حذف</button>
        `;
        container.appendChild(div);
    }
    
    function addOutcomeItem() {
        const container = document.getElementById('outcomes-container');
        const div = document.createElement('div');
        div.className = 'dynamic-item';
        div.innerHTML = `
            <input type="text" name="learning_outcomes[]" placeholder="مثال: إدارة حملات TikTok Ads من الصفر" class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" style="border-color: #E5E7EB;">
            <button type="button" class="remove-btn mt-2" onclick="this.parentElement.remove()">حذف</button>
        `;
        container.appendChild(div);
    }
    
    function addTargetItem() {
        const container = document.getElementById('target-container');
        const div = document.createElement('div');
        div.className = 'dynamic-item';
        div.innerHTML = `
            <input type="text" name="who_is_this_for[]" placeholder="مثال: من يريد العمل كميديا بير" class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" style="border-color: #E5E7EB;">
            <button type="button" class="remove-btn mt-2" onclick="this.parentElement.remove()">حذف</button>
        `;
        container.appendChild(div);
    }
    
    function addSection() {
        const container = document.getElementById('outline-container');
        const currentIndex = sectionIndex++;
        const div = document.createElement('div');
        div.className = 'dynamic-item';
        div.style.background = '#FFFFFF';
        div.style.border = '2px solid #04c2eb';
        div.innerHTML = `
            <div class="mb-4">
                <label class="block text-sm font-medium text-textDark mb-2">اسم القسم</label>
                <input type="text" name="course_outline[${currentIndex}][title]" placeholder="مثال: مقدمة في الميديا بيرينج" class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" style="border-color: #E5E7EB;">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-textDark mb-2">الدروس</label>
                <div id="lessons-${currentIndex}"></div>
                <button type="button" class="add-btn" onclick="addLesson(${currentIndex})">+ إضافة درس</button>
            </div>
            <button type="button" class="remove-btn" onclick="this.parentElement.remove()">حذف القسم</button>
        `;
        container.appendChild(div);
    }
    
    function addLesson(sectionIndex) {
        const container = document.getElementById('lessons-' + sectionIndex);
        const lessonIndex = container.children.length;
        const div = document.createElement('div');
        div.className = 'flex gap-2 mb-2';
        div.innerHTML = `
            <input type="text" name="course_outline[${sectionIndex}][lessons][${lessonIndex}][title]" placeholder="اسم الدرس" class="flex-1 px-4 py-2 border-2 rounded-lg" style="border-color: #E5E7EB;">
            <input type="text" name="course_outline[${sectionIndex}][lessons][${lessonIndex}][duration]" placeholder="المدة" class="w-32 px-4 py-2 border-2 rounded-lg" style="border-color: #E5E7EB;">
            <button type="button" class="remove-btn" onclick="this.parentElement.remove()">حذف</button>
        `;
        container.appendChild(div);
    }
    
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.classList.add('hidden');
        }
    }
    
    function addReview() {
        const container = document.getElementById('reviews-container');
        const reviewIndex = container.children.length;
        const div = document.createElement('div');
        div.className = 'dynamic-item';
        div.style.background = '#FFFFFF';
        div.style.border = '2px solid #04c2eb';
        div.innerHTML = `
            <div class="mb-4">
                <label class="block text-sm font-medium text-textDark mb-2">اسم الطالب</label>
                <input type="text" name="reviews[${reviewIndex}][name]" placeholder="مثال: محمد أحمد" class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" style="border-color: #E5E7EB;">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-textDark mb-2">نص الرأي</label>
                <textarea name="reviews[${reviewIndex}][text]" rows="4" placeholder="اكتب رأي الطالب في الدورة..." class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors resize-none" style="border-color: #E5E7EB;"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-textDark mb-2">التقييم (من 5)</label>
                <select name="reviews[${reviewIndex}][rating]" class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" style="border-color: #E5E7EB;">
                    <option value="5">5 نجوم</option>
                    <option value="4">4 نجوم</option>
                    <option value="3">3 نجوم</option>
                    <option value="2">2 نجوم</option>
                    <option value="1">1 نجمة</option>
                </select>
            </div>
            <button type="button" class="remove-btn" onclick="this.parentElement.remove()">حذف الرأي</button>
        `;
        container.appendChild(div);
    }
    
    function addTrainer() {
        const container = document.getElementById('trainers-container');
        const trainerIndex = container.children.length;
        const div = document.createElement('div');
        div.className = 'dynamic-item';
        div.style.background = '#FFFFFF';
        div.style.border = '2px solid #04c2eb';
        div.innerHTML = `
            <div class="mb-4">
                <label class="block text-sm font-medium text-textDark mb-2">اسم المدرب</label>
                <input type="text" name="trainers[${trainerIndex}][name]" placeholder="مثال: أحمد ماهر" class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" style="border-color: #E5E7EB;">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-textDark mb-2">الوصف</label>
                <textarea name="trainers[${trainerIndex}][description]" rows="4" placeholder="اكتب وصفاً عن المدرب وخبراته..." class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors resize-none" style="border-color: #E5E7EB;"></textarea>
            </div>
            <button type="button" class="remove-btn" onclick="this.parentElement.remove()">حذف المدرب</button>
        `;
        container.appendChild(div);
    }
    
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.classList.add('hidden');
        }
    }
</script>
@endpush
@endsection

