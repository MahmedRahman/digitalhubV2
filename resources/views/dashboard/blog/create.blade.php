@extends('layouts.dashboard')

@section('title', 'إضافة مقال جديد')
@section('page-title', 'إضافة مقال جديد')
@section('page-description', 'أضف مقال جديد إلى المدونة')

@section('content')
    <div class="max-w-4xl">
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
        
        @if($errors->any())
            <div class="bg-red-50 border-2 border-red-300 rounded-xl p-6 mb-6">
                <div class="flex items-start gap-3 mb-4">
                    <svg class="w-6 h-6 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-red-800 mb-2">يرجى تصحيح الأخطاء التالية:</h3>
                        <ul class="list-disc list-inside space-y-2 text-red-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        
        <!-- Required Fields Info -->
        <div class="bg-blue-50 border-2 border-blue-200 rounded-xl p-6 mb-6">
            <div class="flex items-start gap-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-blue-800 mb-3">الحقول المطلوبة لحفظ المقال:</h3>
                    <div class="grid md:grid-cols-2 gap-3 text-sm text-blue-700">
                        <div class="flex items-center gap-2">
                            <span class="text-red-500 font-bold">*</span>
                            <span>عنوان المقال</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-red-500 font-bold">*</span>
                            <span>الملخص</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-red-500 font-bold">*</span>
                            <span>محتوى المقال</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-red-500 font-bold">*</span>
                            <span>اسم الكاتب</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-red-500 font-bold">*</span>
                            <span>تاريخ النشر</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-red-500 font-bold">*</span>
                            <span>التصنيف</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-red-500 font-bold">*</span>
                            <span>الحالة (منشور/مسودة)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <form method="POST" action="{{ route('dashboard.blog.store') }}" class="space-y-6" enctype="multipart/form-data">
            @csrf
            
            <div class="bg-white rounded-xl p-6 border-2" style="border-color: #111111;">
                <h2 class="text-xl font-heading font-bold text-textDark mb-6">معلومات المقال</h2>
                
                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-textDark mb-2">
                            عنوان المقال <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="title"
                            name="title" 
                            value="{{ old('title') }}" 
                            required
                            placeholder="مثال: كيف تبدأ في تعلم البرمجة؟"
                            class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                            style="border-color: #E5E7EB;"
                        >
                        @error('title')
                            <p class="mt-1 text-sm text-red-600 font-medium flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
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
                            value="{{ old('slug') }}" 
                            placeholder="سيتم إنشاؤه تلقائياً من عنوان المقال"
                            class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                            style="border-color: #E5E7EB;"
                        >
                        <p class="mt-1 text-xs text-textMuted">مثال: how-to-start-programming</p>
                    </div>
                    
                    <!-- Featured Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-textDark mb-2">
                            صورة المقال الرئيسية
                        </label>
                        <div class="flex items-center gap-4">
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
                                <p class="mt-1 text-xs text-blue-600 font-medium">📐 <strong>ملاحظة:</strong> المقاسات المناسبة للصور: 1200x675 بكسل (نسبة 16:9) لضمان ظهورها بشكل سليم على الموقع</p>
                            </div>
                            <div id="image-preview" class="hidden">
                                <img id="preview-img" src="" alt="Preview" class="w-32 h-32 object-cover rounded-lg border-2" style="border-color: #E5E7EB;">
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
                    
                    <!-- Excerpt -->
                    <div>
                        <label for="excerpt" class="block text-sm font-medium text-textDark mb-2">
                            الملخص <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="excerpt"
                            name="excerpt" 
                            rows="3"
                            required
                            placeholder="ملخص قصير يظهر في قائمة المقالات..."
                            class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors resize-none" 
                            style="border-color: #E5E7EB;"
                        >{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                            <p class="mt-1 text-sm text-red-600 font-medium flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-textDark mb-2">
                            محتوى المقال <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            id="content"
                            name="content" 
                            rows="12"
                            required
                            placeholder="اكتب محتوى المقال هنا..."
                            class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors resize-none" 
                            style="border-color: #E5E7EB;"
                        >{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600 font-medium flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <!-- Author, Date, Read Time, Category -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="author" class="block text-sm font-medium text-textDark mb-2">
                                اسم الكاتب <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="author"
                                name="author" 
                                value="{{ old('author') }}" 
                                required
                                placeholder="مثال: أحمد محمد"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                style="border-color: #E5E7EB;"
                            >
                            @error('author')
                                <p class="mt-1 text-sm text-red-600 font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="date" class="block text-sm font-medium text-textDark mb-2">
                                تاريخ النشر <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="date" 
                                id="date"
                                name="date" 
                                value="{{ old('date', date('Y-m-d')) }}" 
                                required
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                style="border-color: #E5E7EB;"
                            >
                            @error('date')
                                <p class="mt-1 text-sm text-red-600 font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label for="read_time" class="block text-sm font-medium text-textDark mb-2">
                                وقت القراءة
                            </label>
                            <input 
                                type="text" 
                                id="read_time"
                                name="read_time" 
                                value="{{ old('read_time', '5 دقائق') }}" 
                                placeholder="مثال: 5 دقائق"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                style="border-color: #E5E7EB;"
                            >
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-medium text-textDark mb-2">
                                التصنيف <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="category"
                                name="category" 
                                value="{{ old('category') }}" 
                                required
                                placeholder="مثال: برمجة"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                style="border-color: #E5E7EB;"
                            >
                            @error('category')
                                <p class="mt-1 text-sm text-red-600 font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
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
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>منشور</option>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600 font-medium flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <!-- Submit Buttons -->
            <div class="bg-white rounded-xl p-6 border-2" style="border-color: #111111;">
                <div class="flex items-center gap-4">
                    <button type="submit" class="btn-primary px-8 py-3">
                        حفظ المقال
                    </button>
                    <a href="{{ route('dashboard.blog.index') }}" class="px-8 py-3 rounded-lg font-medium border-2 transition-colors" style="border-color: #E5E7EB; color: #6B6F73;">
                        إلغاء
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection

