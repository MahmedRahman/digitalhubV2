@extends('layouts.app')

@section('title', $course['hero_title'] ?? $course['title'] ?? 'تفاصيل الدورة')
@section('description', $course['short_description'] ?? '')

@section('content')
    <!-- Course Header -->
    <div class="bg-white py-8 lg:py-12 border-b" style="border-color: #F5F6F7;">
        <div class="container-custom">
            <!-- First Row: Course Info and Image -->
            <div class="flex flex-col lg:flex-row gap-6 mb-6">
                <!-- Left Column: Course Info (30%) -->
                <div class="lg:w-[30%]">
                    <!-- Course Title and Info -->
                    <div class="mb-2">
                        <span class="text-sm font-medium" style="color: #6B6F73;">الدورات</span>
                    </div>
                    <h1 class="text-2xl lg:text-3xl font-heading font-bold text-textDark mb-3">
                        {{ $course['hero_title'] ?? $course['title'] ?? 'الدورة' }}
                    </h1>
                    <p class="text-base text-textMuted mb-4">
                        {{ $course['hero_subtitle'] ?? $course['short_description'] ?? '' }}
                    </p>
                        <div class="flex flex-wrap items-center gap-4 mb-4">
                        <div class="flex items-center gap-2 px-3 py-2 rounded-lg" style="background-color: rgba(4, 194, 235, 0.08);">
                            <svg class="w-5 h-5" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm font-medium text-textDark">{{ $course['stats_bar']['duration'] ?? $course['duration'] ?? '' }}</span>
                        </div>
                        <div class="flex items-center gap-2 px-3 py-2 rounded-lg" style="background-color: rgba(4, 194, 235, 0.08);">
                            <svg class="w-5 h-5" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm font-medium text-textDark">{{ $course['stats_bar']['lessons'] ?? ($course['lessons_count'] ?? 0) . ' درس عملي' }}</span>
                        </div>
                        <div class="flex items-center gap-2 px-3 py-2 rounded-lg" style="background-color: rgba(4, 194, 235, 0.12);">
                            <svg class="w-5 h-5" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm font-medium text-textDark">{{ $course['stats_bar']['level'] ?? $course['level'] ?? '' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Image (70%) -->
                <div class="lg:w-[70%]">
                    <!-- Course Image -->
                    @if(isset($course['image']) && $course['image'])
                        <div class="rounded-2xl overflow-hidden" style="aspect-ratio: 16/6.3; max-width: 100%;">
                            <img src="{{ asset('storage/' . $course['image']) }}" alt="{{ $course['title'] ?? 'صورة الدورة' }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="rounded-2xl overflow-hidden flex items-center justify-center" style="aspect-ratio: 16/6.3; background: linear-gradient(to bottom right, rgba(4, 194, 235, 0.8), rgba(4, 194, 235, 1)); max-width: 100%;">
                            <svg class="w-24 h-24 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Second Row: Course Description and Price Card -->
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Left Column: Course Description (70%) -->
                <div class="lg:w-[70%]">
                    <h2 class="text-xl lg:text-2xl font-heading font-bold text-textDark mb-3">
                        عن هذه الدورة
                    </h2>
                    <div class="prose prose-lg max-w-none leading-relaxed">
                        @if(isset($course['course_overview']) && is_array($course['course_overview']))
                            @foreach($course['course_overview'] as $paragraph)
                                <p class="mb-3 text-textMuted">{{ $paragraph }}</p>
                            @endforeach
                        @endif
                        
                        @if(isset($course['learning_outcomes']) && is_array($course['learning_outcomes']) && count($course['learning_outcomes']) > 0)
                            <h3 class="text-lg font-heading font-bold text-textDark mt-4 mb-2">ما ستتعلمه:</h3>
                            <ul class="list-disc list-inside space-y-2 mb-3 text-textMuted">
                                @foreach($course['learning_outcomes'] as $outcome)
                                    <li>{{ $outcome }}</li>
                                @endforeach
                            </ul>
                        @endif
                        
                        @if(isset($course['who_is_this_for']) && is_array($course['who_is_this_for']) && count($course['who_is_this_for']) > 0)
                            <h3 class="text-lg font-heading font-bold text-textDark mt-4 mb-2">هذا الكورس مناسب لـ:</h3>
                            <ul class="list-disc list-inside space-y-2 mb-3 text-textMuted">
                                @foreach($course['who_is_this_for'] as $target)
                                    <li>{{ $target }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                    <!-- Course Curriculum -->
                    <div class="mt-8">
                        <h2 class="text-xl lg:text-2xl font-heading font-bold text-textDark mb-4">
                            محتوى الكورس
                        </h2>
                        <div class="space-y-2" id="curriculum-accordion">
                            @if(isset($course['course_outline']) && is_array($course['course_outline']) && count($course['course_outline']) > 0)
                                @foreach($course['course_outline'] as $index => $section)
                                    @php
                                        $lessonsCount = 0;
                                        if (isset($section) && is_array($section) && isset($section['lessons']) && is_array($section['lessons'])) {
                                            $lessonsCount = count($section['lessons']);
                                        }
                                    @endphp
                                <div class="accordion-item border-2 rounded-lg overflow-hidden" style="border-color: #E5E7EB; background-color: #F9FAFB;">
                                    <button 
                                        class="w-full flex items-center justify-between text-right p-4 focus:outline-none"
                                        style="focus:ring-2; focus:ring-color: rgba(4, 194, 235, 0.3);"
                                        aria-expanded="false"
                                        aria-controls="section-{{ $index }}"
                                        id="section-button-{{ $index }}"
                                        type="button"
                                    >
                                        <div class="flex-1 text-right">
                                            <h3 class="font-heading font-bold text-lg mb-1 text-textDark">
                                                {{ isset($section['title']) ? $section['title'] : 'قسم بدون عنوان' }}
                                            </h3>
                                            <p class="text-sm text-textMuted">
                                                {{ $lessonsCount }} دروس
                                            </p>
                                        </div>
                                        <svg 
                                            class="w-6 h-6 transition-transform duration-300 transform text-textMuted"
                                            fill="none" 
                                            stroke="currentColor" 
                                            viewBox="0 0 24 24"
                                            id="section-icon-{{ $index }}"
                                        >
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div 
                                        class="hidden overflow-hidden"
                                        id="section-{{ $index }}"
                                        role="region"
                                        aria-labelledby="section-button-{{ $index }}"
                                        style="max-height: 0; opacity: 0;"
                                    >
                                        <div class="px-4 pt-4 pb-4 space-y-2" style="background-color: #FFFFFF;">
                                            @if(isset($section['lessons']) && is_array($section['lessons']) && count($section['lessons']) > 0)
                                                @foreach($section['lessons'] as $lessonIndex => $lesson)
                                                    <div class="flex items-center justify-between p-3 rounded border" style="background-color: #F5F6F7; border-color: #E5E7EB;">
                                                        <div class="flex items-center gap-3">
                                                            <div class="w-8 h-8 rounded flex items-center justify-center text-sm font-medium" style="background-color: rgba(4, 194, 235, 0.12); color: #04c2eb;">
                                                                {{ $lessonIndex + 1 }}
                                                            </div>
                                                            <span class="font-medium text-textDark">{{ $lesson['title'] ?? 'درس بدون عنوان' }}</span>
                                                        </div>
                                                        <span class="text-sm text-textMuted">{{ $lesson['duration'] ?? '' }}</span>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="text-center py-4 text-textMuted">
                                                    <p class="text-sm">لا توجد دروس متاحة في هذا القسم</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column: Price Card (30%) -->
                <div class="lg:w-[30%]">
                    <div class="card sticky top-24">
                        <div class="mb-3">
                            <span class="px-3 py-1 rounded-lg text-xs font-medium" style="background-color: rgba(4, 194, 235, 0.12); color: #04c2eb;">
                                السعر
                            </span>
                        </div>
                            <div class="text-center mb-4">
                            <div class="text-4xl font-heading font-bold mb-2" style="color: #111111;">
                                {{ number_format($course['price'] ?? 0) }}
                            </div>
                            <div class="text-textMuted">{{ $course['currency'] ?? 'جنيه' }}</div>
                        </div>
                        <div class="mb-4">
                            <p class="text-sm font-medium mb-2" style="color: #111111;">السعر يتضمن:</p>
                            <ul class="space-y-2 text-sm text-textMuted">
                                <li class="flex items-start gap-2">
                                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>وصول مدى الحياة</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>شهادة إتمام</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>دعم فني متواصل</span>
                                </li>
                            </ul>
                        </div>
                        @php
                            $settings = \App\Helpers\ContentHelper::getSiteSettings();
                            $whatsappNumber = $settings['whatsapp'] ?? '';
                            $courseTitle = $course['title'] ?? $course['hero_title'] ?? 'الدورة';
                            $coursePrice = number_format($course['price'] ?? 0);
                            $courseCurrency = $course['currency'] ?? 'جنيه';
                            $whatsappMessage = urlencode("مرحباً، أريد التسجيل في دورة: {$courseTitle}\nالسعر: {$coursePrice} {$courseCurrency}\nالرابط: " . url()->current());
                        @endphp
                        @if($whatsappNumber && trim($whatsappNumber) !== '')
                            <a 
                                href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}?text={{ $whatsappMessage }}" 
                                target="_blank" 
                                rel="noopener noreferrer"
                                class="block w-full text-center btn-primary mb-3"
                            >
                                {{ isset($course['final_cta_block']) && isset($course['final_cta_block']['button_text']) ? $course['final_cta_block']['button_text'] : 'سجل الآن' }}
                            </a>
                        @else
                            <a href="#" class="block w-full text-center btn-primary mb-3">
                                {{ isset($course['final_cta_block']) && isset($course['final_cta_block']['button_text']) ? $course['final_cta_block']['button_text'] : 'سجل الآن' }}
                            </a>
                        @endif
                        @if(isset($course['download_link']) && !empty($course['download_link']))
                            <a 
                                href="{{ $course['download_link'] }}" 
                                target="_blank" 
                                rel="noopener noreferrer"
                                class="block w-full text-center btn-outline mb-3"
                            >
                                <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                تحميل المحتوى
                            </a>
                        @else
                            <button 
                                type="button"
                                disabled
                                class="block w-full text-center btn-outline mb-3 opacity-50 cursor-not-allowed"
                            >
                                <svg class="w-5 h-5 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                تحميل المحتوى
                            </button>
                        @endif
                        <div class="text-center text-sm text-textMuted">
                            <span class="flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                تاريخ البدء: {{ isset($course['stats_bar']) && isset($course['stats_bar']['duration']) ? $course['stats_bar']['duration'] : ($course['duration'] ?? '') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trainers Section -->
    <section class="py-8 lg:py-12 bg-bgSoft">
        <div class="container-custom">
            <div class="mb-6">
                <h2 class="text-2xl lg:text-3xl font-heading font-bold text-textDark mb-2">
                    المدربين
                </h2>
                <p class="text-base text-textMuted">
                    تعرف على مدربينا الخبراء
                </p>
            </div>
            
            <div class="space-y-4 w-full">
                @if(isset($course['trainers']) && is_array($course['trainers']) && count($course['trainers']) > 0)
                    @foreach($course['trainers'] as $trainer)
                        <div class="bg-white border-2 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow duration-200 w-full" style="border-color: #F5F6F7;">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-16 h-16 rounded-full overflow-hidden bg-bgSoft flex items-center justify-center">
                                        <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="12" cy="8" r="4" fill="#04c2eb"/>
                                            <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" stroke="#04c2eb" stroke-width="2" fill="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-heading font-bold text-lg mb-2 text-textDark">
                                        {{ $trainer['name'] ?? '' }}
                                    </h3>
                                    <p class="text-sm leading-relaxed text-textMuted">
                                        {{ $trainer['description'] ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="bg-white border-2 rounded-xl p-4 shadow-sm w-full" style="border-color: #F5F6F7;">
                        <p class="text-textMuted text-center">لا يوجد مدربون مسجلون لهذه الدورة</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Student Reviews Section -->
    <section class="py-12 lg:py-16 bg-white">
        <div class="container-custom">
            <div class="mb-8">
                <h2 class="text-2xl lg:text-3xl font-heading font-bold text-textDark mb-4">
                    آراء الطلاب
                </h2>
                <p class="text-lg text-textMuted">
                    ما يقوله طلابنا عن هذه الدورة
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(isset($course['reviews']) && is_array($course['reviews']) && count($course['reviews']) > 0)
                    @foreach($course['reviews'] as $review)
                        <div class="card">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-12 h-12 rounded-full overflow-hidden bg-bgSoft flex items-center justify-center">
                                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="8" r="4" fill="#04c2eb"/>
                                        <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" stroke="#04c2eb" stroke-width="2" fill="none"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-heading font-bold text-textDark">{{ $review['name'] ?? 'طالب' }}</h4>
                                    <div class="flex items-center gap-1">
                                        @for($i = 0; $i < ($review['rating'] ?? 5); $i++)
                                            <svg class="w-4 h-4" style="color: #FBBF24;" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                        @for($i = ($review['rating'] ?? 5); $i < 5; $i++)
                                            <svg class="w-4 h-4" style="color: #E5E7EB;" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-textMuted leading-relaxed">
                                {{ $review['text'] ?? '' }}
                            </p>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                        <p class="text-lg font-medium text-textMuted mb-2">لا توجد آراء متاحة حالياً</p>
                        <p class="text-sm text-textMuted">سيتم إضافة آراء الطلاب قريباً</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Discover Other Courses Section -->
    <section class="py-12 lg:py-16 bg-white">
        <div class="container-custom">
            <div class="mb-8">
                <h2 class="text-2xl lg:text-3xl font-heading font-bold text-textDark">
                    اكتشف الدورات الأخرى
                </h2>
            </div>

            @php
                $allCourses = \App\Helpers\ContentHelper::getCourses();
                $currentCourseId = $course['id'] ?? null;
                $otherCourses = collect($allCourses)
                    ->filter(function($c) use ($currentCourseId) {
                        return ($c['status'] ?? 'inactive') === 'active' && ($c['id'] ?? null) != $currentCourseId;
                    })
                    ->take(4)
                    ->values()
                    ->all();
            @endphp
            
            @if(count($otherCourses) > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($otherCourses as $otherCourse)
                        <a href="{{ route('courses.show', $otherCourse['id'] ?? 0) }}" class="card course-card block hover:shadow-lg transition-shadow">
                            <div class="relative mb-4">
                                <div class="aspect-video rounded-xl overflow-hidden">
                                    @if(isset($otherCourse['image']) && $otherCourse['image'])
                                        <img src="{{ asset('storage/' . $otherCourse['image']) }}" alt="{{ $otherCourse['title'] ?? 'صورة الدورة' }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center" style="background: linear-gradient(135deg, rgba(4, 194, 235, 0.8), rgba(4, 194, 235, 1));">
                                            <svg class="w-20 h-20 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="mb-2">
                                <span class="text-xs font-medium" style="color: #6B6F73;">{{ $otherCourse['category_name'] ?? $otherCourse['category'] ?? 'دورة' }}</span>
                            </div>
                            <h3 class="font-heading font-bold text-lg text-textDark mb-3 line-clamp-2">
                                {{ $otherCourse['title'] ?? 'بدون عنوان' }}
                            </h3>
                            <div class="flex items-center gap-2 text-sm text-textMuted mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $otherCourse['duration'] ?? '' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-heading font-bold" style="color: #04c2eb;">
                                    {{ number_format($otherCourse['price'] ?? 0) }} 
                                    <span class="text-sm font-normal text-textMuted">{{ $otherCourse['currency'] ?? 'جنيه' }}</span>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <p class="text-lg font-medium text-textMuted mb-2">لا توجد دورات أخرى متاحة حالياً</p>
                    <p class="text-sm text-textMuted">سيتم إضافة المزيد من الدورات قريباً</p>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-12 lg:py-16 text-white" style="background-color: #04c2eb;">
        <div class="container-custom text-center">
            <h2 class="text-3xl lg:text-4xl font-heading font-bold mb-3">
                {{ isset($course['final_cta_block']) && isset($course['final_cta_block']['headline']) ? $course['final_cta_block']['headline'] : 'ابدأ رحلتك في التعلم' }}
            </h2>
            <p class="text-lg lg:text-xl mb-6 max-w-2xl mx-auto" style="color: rgba(255, 255, 255, 0.9);">
                {{ isset($course['final_cta_block']) && isset($course['final_cta_block']['text']) ? $course['final_cta_block']['text'] : 'انضم إلى الكورس وابدأ في بناء مهاراتك العملية.' }}
            </p>
            @php
                if (!isset($settings)) {
                    $settings = \App\Helpers\ContentHelper::getSiteSettings();
                }
                if (!isset($whatsappNumber)) {
                    $whatsappNumber = $settings['whatsapp'] ?? '';
                }
                if (!isset($courseTitle)) {
                    $courseTitle = $course['title'] ?? $course['hero_title'] ?? 'الدورة';
                }
                if (!isset($coursePrice)) {
                    $coursePrice = number_format($course['price'] ?? 0);
                }
                if (!isset($courseCurrency)) {
                    $courseCurrency = $course['currency'] ?? 'جنيه';
                }
                $whatsappMessage = urlencode("مرحباً، أريد التسجيل في دورة: {$courseTitle}\nالسعر: {$coursePrice} {$courseCurrency}\nالرابط: " . url()->current());
            @endphp
            @if($whatsappNumber && trim($whatsappNumber) !== '')
                <a 
                    href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}?text={{ $whatsappMessage }}" 
                    target="_blank" 
                    rel="noopener noreferrer"
                    class="inline-block text-white px-8 py-4 rounded-xl font-medium text-lg transition-colors duration-200 hover:bg-white hover:text-primary" 
                    style="background-color: rgba(255, 255, 255, 0.2);"
                >
                    {{ isset($course['final_cta_block']) && isset($course['final_cta_block']['button_text']) ? $course['final_cta_block']['button_text'] : 'سجل الآن' }}
                </a>
            @else
                <a href="#" class="inline-block text-white px-8 py-4 rounded-xl font-medium text-lg transition-colors duration-200" style="background-color: rgba(255, 255, 255, 0.2);">
                    {{ isset($course['final_cta_block']) && isset($course['final_cta_block']['button_text']) ? $course['final_cta_block']['button_text'] : 'سجل الآن' }}
                </a>
            @endif
        </div>
    </section>
@endsection

