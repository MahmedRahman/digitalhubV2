@php
    // إذا كان isStandalone غير موجود أو true = صفحة مستقلة (يستخدم layout)
    // إذا كان isStandalone = false = included في dashboard (لا يستخدم layout)
    $isIncluded = isset($isStandalone) && $isStandalone === false;
    $content = $content ?? \App\Helpers\ContentHelper::getHomepageContent();
    $editor_mode = $editor_mode ?? false;
    $hero = $content['hero'] ?? [];
    $about = $content['about'] ?? [];
    $trust_signals = $content['trust_signals'] ?? [];
    $features = $content['features'] ?? [];
    $courses = $content['courses'] ?? [];
    $reviews = $content['reviews'] ?? [];
    $banner = $content['banner'] ?? [];
@endphp

@if(!$isIncluded)
@extends('layouts.app')

@section('title', 'الرئيسية')
@section('description', 'منصة تعليمية عربية متخصصة في تقديم دورات تدريبية عالية الجودة')

@section('content')
@endif
    <!-- Hero Section -->
    <section 
        class="py-16 lg:py-24 section-editable" 
        style="background-color: {{ $hero['backgroundColor'] ?? '#04c2eb' }};"
        @if($editor_mode) data-section="hero" data-section-name="Hero Section" @endif
    >
        <div class="container-custom">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Illustration Side (Left in RTL) -->
                <div class="hidden lg:block order-2 lg:order-1">
                    <div class="relative">
                        <!-- Hero Image -->
                        @if(isset($hero['image']) && $hero['image'])
                            <div class="relative z-10" 
                                 @if($editor_mode) data-editable="true" data-section="hero" data-field="image" data-type="image" style="cursor: pointer;" @endif>
                                <img src="{{ asset('storage/' . $hero['image']) }}" alt="Hero Image" class="w-full max-w-md rounded-xl shadow-lg" style="display: block !important; position: relative !important; z-index: 1 !important; visibility: visible !important; opacity: 1 !important;">
                                @if($editor_mode)
                                    <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-20 transition-all duration-200 rounded-xl flex items-center justify-center" style="z-index: 2; pointer-events: none;">
                                        <div class="opacity-0 hover:opacity-100 text-white text-center p-4" style="pointer-events: none;">
                                            <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <p class="text-sm font-medium">اضغط لرفع صورة</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <!-- Person Illustration -->
                            <div class="relative z-10"
                                 @if($editor_mode) data-editable="true" data-section="hero" data-field="image" data-type="image" style="cursor: pointer;" @endif>
                                <svg class="w-full max-w-md" viewBox="0 0 400 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <!-- Person -->
                                    <circle cx="200" cy="120" r="50" fill="#111111"/>
                                    <rect x="150" y="170" width="100" height="120" rx="20" fill="#111111"/>
                                    <!-- Headphones -->
                                    <ellipse cx="150" cy="100" rx="30" ry="20" fill="none" stroke="#111111" stroke-width="3"/>
                                    <ellipse cx="250" cy="100" rx="30" ry="20" fill="none" stroke="#111111" stroke-width="3"/>
                                    <path d="M120 100 Q150 90 150 100" stroke="#111111" stroke-width="3" fill="none"/>
                                    <path d="M250 100 Q280 90 280 100" stroke="#111111" stroke-width="3" fill="none"/>
                                    <!-- Arms -->
                                    <path d="M150 200 Q120 220 110 250" stroke="#111111" stroke-width="8" stroke-linecap="round"/>
                                    <path d="M250 200 Q280 220 290 250" stroke="#111111" stroke-width="8" stroke-linecap="round"/>
                                    <!-- Laptop -->
                                    <rect x="180" y="280" width="140" height="100" rx="5" fill="#F5F6F7" stroke="#111111" stroke-width="2"/>
                                    <rect x="190" y="290" width="120" height="80" fill="#111111"/>
                                    <circle cx="250" cy="330" r="25" fill="#FFFFFF"/>
                                    <path d="M240 330 L250 320 L260 330" stroke="#111111" stroke-width="2" fill="none"/>
                                </svg>
                                @if($editor_mode)
                                    <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-20 transition-all duration-200 rounded-xl flex items-center justify-center pointer-events-none" style="z-index: 2;">
                                        <div class="opacity-0 hover:opacity-100 text-white text-center p-4 pointer-events-none">
                                            <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <p class="text-sm font-medium">اضغط لرفع صورة</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Text and Form Side (Right in RTL) -->
                <div class="text-center lg:text-right order-1 lg:order-2">
                    <h1 
                        class="text-{{ $hero['title']['fontSize'] ?? '4xl' }} lg:text-5xl xl:text-6xl font-heading font-bold mb-6 leading-tight" 
                        style="color: {{ $hero['title']['color'] ?? '#FFFFFF' }};"
                        @if($editor_mode) data-editable="true" data-section="hero" data-field="title.text" data-type="text" @endif
                    >
                        {{ $hero['title']['text'] ?? 'تعلم التسويق الرقمي' }}
                    </h1>
                    <p 
                        class="text-lg lg:text-xl mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0" 
                        style="color: {{ $hero['subtitle']['color'] ?? '#FFFFFF' }};"
                        @if($editor_mode) data-editable="true" data-section="hero" data-field="subtitle.text" data-type="text" @endif
                    >
                        {{ $hero['subtitle']['text'] ?? 'مباشر، تفاعلي وعملي بالكامل' }}
                    </p>
                    
                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a 
                            href="{{ $hero['button1']['link'] ?? route('courses.index') }}" 
                            class="px-8 py-4 rounded-xl font-medium text-lg text-center whitespace-nowrap"
                            style="background-color: {{ $hero['button1']['backgroundColor'] ?? '#FFFFFF' }}; color: {{ $hero['button1']['textColor'] ?? '#111111' }}; border: 2px solid {{ $hero['button1']['borderColor'] ?? '#111111' }};"
                            @if(isset($hero['button1']['external']) && $hero['button1']['external']) target="_blank" rel="noopener noreferrer" @endif
                            @if($editor_mode) data-editable="true" data-section="hero" data-field="button1.text" data-type="text" data-link-field="button1.link" @endif
                        >
                            {{ $hero['button1']['text'] ?? 'تصفح الكورسات' }}
                        </a>
                        <a 
                            href="{{ $hero['button2']['link'] ?? route('register') }}" 
                            class="px-8 py-4 rounded-xl font-medium text-lg text-center whitespace-nowrap"
                            style="background-color: {{ $hero['button2']['backgroundColor'] ?? '#111111' }}; color: {{ $hero['button2']['textColor'] ?? '#FFFFFF' }};"
                            @if(isset($hero['button2']['external']) && $hero['button2']['external']) target="_blank" rel="noopener noreferrer" @endif
                            @if($editor_mode) data-editable="true" data-section="hero" data-field="button2.text" data-type="text" data-link-field="button2.link" @endif
                        >
                            {{ $hero['button2']['text'] ?? 'سجل معنا' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section 
        class="py-16 lg:py-24 bg-white section-editable"
        @if($editor_mode) data-section="about" data-section-name="من نحن" @endif
    >
        <div class="container-custom">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Text Side (Left in RTL) -->
                <div class="text-center lg:text-right order-1 lg:order-1">
                    <h2 
                        class="text-lg lg:text-xl font-medium mb-4" 
                        style="color: {{ $about['badge']['color'] ?? '#04c2eb' }};"
                        @if($editor_mode) data-editable="true" data-section="about" data-field="badge.text" data-type="text" @endif
                    >
                        {{ $about['badge']['text'] ?? 'من نحن؟ تعرف علينا' }}
                    </h2>
                    <h3 
                        class="text-{{ $about['title']['fontSize'] ?? '3xl' }} lg:text-4xl xl:text-5xl font-heading font-bold mb-6 leading-tight" 
                        style="color: {{ $about['title']['color'] ?? '#111111' }};"
                        @if($editor_mode) data-editable="true" data-section="about" data-field="title.text" data-type="text" @endif
                    >
                        {{ $about['title']['text'] ?? 'نقدم محتوى تعليمي عربي عالي الجودة' }}
                    </h3>
                    <p 
                        class="text-base lg:text-lg mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0" 
                        style="color: {{ $about['description']['color'] ?? '#111111' }};"
                        @if($editor_mode) data-editable="true" data-section="about" data-field="description.text" data-type="text" @endif
                    >
                        {{ $about['description']['text'] ?? 'منصة تعليمية تهدف لمساعدتك على النجاح في مجال التسويق الرقمي، وتهدف دوراتنا لتنمية مهارات كلاً من المبتدئين والمحترفين من خلال التركيز على المهارات العملية والمحاضرات التفاعلية المباشرة.' }}
                    </p>
                    <a 
                        href="{{ $about['button']['link'] ?? route('about') }}" 
                        class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-medium transition-all duration-200" 
                        style="background-color: {{ $about['button']['backgroundColor'] ?? '#FFFFFF' }}; color: {{ $about['button']['textColor'] ?? '#111111' }}; border: 2px solid {{ $about['button']['borderColor'] ?? '#111111' }};" 
                        onmouseover="this.style.backgroundColor='#F5F6F7'" 
                        onmouseout="this.style.backgroundColor='{{ $about['button']['backgroundColor'] ?? '#FFFFFF' }}'"
                        @if($editor_mode) data-editable="true" data-section="about" data-field="button.text" data-type="text" @endif
                    >
                        {{ $about['button']['text'] ?? 'اعرف اكثر' }}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Illustration Side (Right in RTL) -->
                <div class="hidden lg:block order-2 lg:order-2">
                    <div class="relative">
                        <!-- Scientist/Student Illustration -->
                        <svg class="w-full max-w-md" viewBox="0 0 400 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Person -->
                            <circle cx="200" cy="120" r="50" fill="#111111"/>
                            <!-- Hair -->
                            <path d="M160 80 Q180 60 200 70 Q220 60 240 80" stroke="#111111" stroke-width="3" fill="none"/>
                            <path d="M170 85 Q190 75 200 80 Q210 75 230 85" stroke="#111111" stroke-width="2" fill="none"/>
                            <!-- Lab Coat -->
                            <rect x="150" y="170" width="100" height="200" rx="5" fill="#FFFFFF" stroke="#111111" stroke-width="3"/>
                            <rect x="170" y="170" width="60" height="80" fill="#111111"/>
                            <!-- Arms -->
                            <path d="M150 220 Q120 240 110 280" stroke="#111111" stroke-width="8" stroke-linecap="round"/>
                            <path d="M250 220 Q280 240 290 280" stroke="#111111" stroke-width="8" stroke-linecap="round"/>
                            <!-- Right Hand Flask (Conical) -->
                            <path d="M110 280 L110 320 L130 340 L130 320 Z" fill="#111111"/>
                            <ellipse cx="120" cy="340" rx="10" ry="5" fill="#111111"/>
                            <circle cx="120" cy="300" r="8" fill="#FFFFFF"/>
                            <circle cx="115" cy="305" r="2" fill="#111111"/>
                            <circle cx="125" cy="310" r="2" fill="#111111"/>
                            <!-- Left Hand Flask (Round-bottom) -->
                            <ellipse cx="290" cy="280" rx="15" ry="20" fill="#111111"/>
                            <rect x="285" y="280" width="10" height="40" fill="#111111"/>
                            <circle cx="290" cy="290" r="8" fill="#FFFFFF"/>
                            <circle cx="285" cy="295" r="2" fill="#111111"/>
                            <circle cx="295" cy="300" r="2" fill="#111111"/>
                            <!-- Table -->
                            <rect x="100" y="360" width="200" height="10" fill="#111111"/>
                            <!-- Table Glassware -->
                            <!-- Flask 1 (Left) -->
                            <ellipse cx="130" cy="360" rx="12" ry="18" fill="#111111"/>
                            <rect x="128" y="360" width="4" height="30" fill="#111111"/>
                            <circle cx="130" cy="370" r="6" fill="#FFFFFF"/>
                            <circle cx="125" cy="375" r="1.5" fill="#111111"/>
                            <circle cx="135" cy="380" r="1.5" fill="#111111"/>
                            <!-- Beaker (Middle) -->
                            <rect x="185" y="350" width="30" height="40" rx="2" fill="#111111"/>
                            <rect x="190" y="355" width="20" height="30" fill="#FFFFFF"/>
                            <circle cx="200" cy="365" r="3" fill="#111111"/>
                            <circle cx="195" cy="375" r="2" fill="#111111"/>
                            <!-- Flask 2 (Right) -->
                            <ellipse cx="270" cy="360" rx="12" ry="18" fill="#111111"/>
                            <rect x="268" y="360" width="4" height="30" fill="#111111"/>
                            <circle cx="270" cy="370" r="6" fill="#FFFFFF"/>
                            <circle cx="265" cy="375" r="1.5" fill="#111111"/>
                            <circle cx="275" cy="380" r="1.5" fill="#111111"/>
                            <!-- Thought Bubble -->
                            <ellipse cx="250" cy="80" rx="40" ry="30" fill="none" stroke="#111111" stroke-width="2" stroke-dasharray="3,3"/>
                            <circle cx="280" cy="100" r="8" fill="none" stroke="#111111" stroke-width="2"/>
                            <circle cx="290" cy="110" r="5" fill="none" stroke="#111111" stroke-width="2"/>
                            <circle cx="295" cy="115" r="3" fill="none" stroke="#111111" stroke-width="2"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Trust Signals -->
    <section 
        class="py-12 section-editable" 
        style="background-color: {{ $trust_signals['backgroundColor'] ?? '#F5F6F7' }};"
        @if($editor_mode) data-section="trust_signals" data-section-name="إحصائيات" @endif
    >
        <div class="container-custom">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div 
                        class="text-3xl lg:text-4xl font-heading font-bold text-textDark mb-2"
                        @if($editor_mode) data-editable="true" data-section="trust_signals" data-field="students.number" data-type="text" @endif
                    >
                        {{ $trust_signals['students']['number'] ?? '10,000+' }}
                    </div>
                    <div 
                        class="text-textMuted text-sm lg:text-base"
                        @if($editor_mode) data-editable="true" data-section="trust_signals" data-field="students.label" data-type="text" @endif
                    >
                        {{ $trust_signals['students']['label'] ?? 'طالب نشط' }}
                    </div>
                </div>
                <div class="text-center">
                    <div 
                        class="text-3xl lg:text-4xl font-heading font-bold text-textDark mb-2"
                        @if($editor_mode) data-editable="true" data-section="trust_signals" data-field="hours.number" data-type="text" @endif
                    >
                        {{ $trust_signals['hours']['number'] ?? '500+' }}
                    </div>
                    <div 
                        class="text-textMuted text-sm lg:text-base"
                        @if($editor_mode) data-editable="true" data-section="trust_signals" data-field="hours.label" data-type="text" @endif
                    >
                        {{ $trust_signals['hours']['label'] ?? 'ساعة تدريب' }}
                    </div>
                </div>
                <div class="text-center">
                    <div 
                        class="text-3xl lg:text-4xl font-heading font-bold text-textDark mb-2"
                        @if($editor_mode) data-editable="true" data-section="trust_signals" data-field="instructors.number" data-type="text" @endif
                    >
                        {{ $trust_signals['instructors']['number'] ?? '50+' }}
                    </div>
                    <div 
                        class="text-textMuted text-sm lg:text-base"
                        @if($editor_mode) data-editable="true" data-section="trust_signals" data-field="instructors.label" data-type="text" @endif
                    >
                        {{ $trust_signals['instructors']['label'] ?? 'محاضر خبير' }}
                    </div>
                </div>
                <div class="text-center">
                    <div 
                        class="text-3xl lg:text-4xl font-heading font-bold text-textDark mb-2"
                        @if($editor_mode) data-editable="true" data-section="trust_signals" data-field="courses.number" data-type="text" @endif
                    >
                        {{ $trust_signals['courses']['number'] ?? '200+' }}
                    </div>
                    <div 
                        class="text-textMuted text-sm lg:text-base"
                        @if($editor_mode) data-editable="true" data-section="trust_signals" data-field="courses.label" data-type="text" @endif
                    >
                        {{ $trust_signals['courses']['label'] ?? 'دورة تدريبية' }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section 
        class="py-16 lg:py-24 bg-white section-editable"
        @if($editor_mode) data-section="features" data-section-name="المميزات" @endif
    >
        <div class="container-custom">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Promotional Message (Left in RTL) -->
                <div class="text-center lg:text-right order-2 lg:order-1">
                    <div class="inline-block px-4 py-2 rounded-lg mb-4" style="background-color: rgba(4, 194, 235, 0.12);">
                        <span 
                            class="text-sm font-medium" 
                            style="color: #04c2eb;"
                            @if($editor_mode) data-editable="true" data-section="features" data-field="badge.text" data-type="text" @endif
                        >
                            {{ $features['badge']['text'] ?? 'مميزات ليرنن' }}
                        </span>
                    </div>
                    <h2 
                        class="text-3xl lg:text-4xl xl:text-5xl font-heading font-bold mb-6 leading-tight" 
                        style="color: #111111;"
                        @if($editor_mode) data-editable="true" data-section="features" data-field="title.text" data-type="text" @endif
                    >
                        {{ $features['title']['text'] ?? 'نقدم محتوى تفاعلي مباشر بشكل عملي لطلابنا!' }}
                    </h2>
                    <p 
                        class="text-base lg:text-lg mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0" 
                        style="color: #6B6F73;"
                        @if($editor_mode) data-editable="true" data-section="features" data-field="description.text" data-type="text" @endif
                    >
                        {{ $features['description']['text'] ?? 'إكتسب مهارات عملية ومعرفة عميقة من خلال دوراتنا المباشرة والتفاعلية التي تربط بدورها بين الدراسة النظرية والتطبيق العملي.' }}
                    </p>
                    <a 
                        href="{{ route('courses.index') }}" 
                        class="btn-primary px-8 py-4 text-lg"
                        @if($editor_mode) data-editable="true" data-section="features" data-field="button.text" data-type="text" @endif
                    >
                        {{ $features['button']['text'] ?? 'تعلم معنا' }}
                    </a>
                </div>

                <!-- Features Grid (Right in RTL) -->
                <div class="order-1 lg:order-2">
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Feature 1: Comprehensive Curriculum -->
                        <div class="bg-white border-2 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-200" style="border-color: #F5F6F7;">
                            <div class="mb-4">
                                <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 2L3 14h8l-2 8 10-12h-8l2-8z" fill="#04c2eb" stroke="#111111" stroke-width="1.5"/>
                                </svg>
                            </div>
                            <h3 
                                class="font-heading font-bold text-lg mb-3" 
                                style="color: #111111;"
                                @if($editor_mode) data-editable="true" data-section="features" data-field="feature1.title" data-type="text" @endif
                            >
                                {{ $features['feature1']['title'] ?? 'منهج شامل' }}
                            </h3>
                            <p 
                                class="text-sm leading-relaxed" 
                                style="color: #6B6F73;"
                                @if($editor_mode) data-editable="true" data-section="features" data-field="feature1.description" data-type="text" @endif
                            >
                                {{ $features['feature1']['description'] ?? 'صممت دوراتنا لتبدأ معك من المستوى المبتدئ لتصل بك إلى المستوى الاحترافي، وذلك من خلال اكتساب جميع المهارات اللازمة لذلك.' }}
                            </p>
                        </div>

                        <!-- Feature 2: Live and Interactive Courses -->
                        <div class="bg-white border-2 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-200" style="border-color: #F5F6F7;">
                            <div class="mb-4">
                                <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="4" width="18" height="12" rx="2" stroke="#04c2eb" stroke-width="2" fill="none"/>
                                    <circle cx="12" cy="10" r="3" fill="#04c2eb"/>
                                    <path d="M7 16l5-3 5 3" stroke="#04c2eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <h3 
                                class="font-heading font-bold text-lg mb-3" 
                                style="color: #111111;"
                                @if($editor_mode) data-editable="true" data-section="features" data-field="feature2.title" data-type="text" @endif
                            >
                                {{ $features['feature2']['title'] ?? 'دورات مباشرة وتفاعلية' }}
                            </h3>
                            <p 
                                class="text-sm leading-relaxed" 
                                style="color: #6B6F73;"
                                @if($editor_mode) data-editable="true" data-section="features" data-field="feature2.description" data-type="text" @endif
                            >
                                {{ $features['feature2']['description'] ?? 'تفاعل مباشر مع المحاضرين والزملاء، لضمان تجربة تعلم مرنة وتعاونية.' }}
                            </p>
                        </div>

                        <!-- Feature 3: Professional Support -->
                        <div class="bg-white border-2 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-200" style="border-color: #F5F6F7;">
                            <div class="mb-4">
                                <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="#F16B78" stroke="#111111" stroke-width="1.5"/>
                                    <path d="M8 12h8M8 16h6" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <h3 
                                class="font-heading font-bold text-lg mb-3" 
                                style="color: #111111;"
                                @if($editor_mode) data-editable="true" data-section="features" data-field="feature3.title" data-type="text" @endif
                            >
                                {{ $features['feature3']['title'] ?? 'الدعم المهني والاستشارات' }}
                            </h3>
                            <p 
                                class="text-sm leading-relaxed" 
                                style="color: #6B6F73;"
                                @if($editor_mode) data-editable="true" data-section="features" data-field="feature3.description" data-type="text" @endif
                            >
                                {{ $features['feature3']['description'] ?? 'نقدم دعم فني واستشارات لطلابنا لمساعدتهم على تخطي التحديات المهنية في سوق العمل.' }}
                            </p>
                        </div>

                        <!-- Feature 4: Practical Projects -->
                        <div class="bg-white border-2 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-200" style="border-color: #F5F6F7;">
                            <div class="mb-4">
                                <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="#04c2eb" stroke-width="2" fill="none"/>
                                    <path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke="#04c2eb" stroke-width="2" fill="none"/>
                                    <path d="M12 2v20" stroke="#04c2eb" stroke-width="2"/>
                                </svg>
                            </div>
                            <h3 
                                class="font-heading font-bold text-lg mb-3" 
                                style="color: #111111;"
                                @if($editor_mode) data-editable="true" data-section="features" data-field="feature4.title" data-type="text" @endif
                            >
                                {{ $features['feature4']['title'] ?? 'مشاريع عملية' }}
                            </h3>
                            <p 
                                class="text-sm leading-relaxed" 
                                style="color: #6B6F73;"
                                @if($editor_mode) data-editable="true" data-section="features" data-field="feature4.description" data-type="text" @endif
                            >
                                {{ $features['feature4']['description'] ?? 'من خلال تطبيق المحتوى النظري الذي تعلمته إلى مهام عملية وواقعية.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Categories -->
    <section 
        class="py-16 lg:py-24 section-editable" 
        style="background-color: {{ $courses['backgroundColor'] ?? '#F5F6F7' }};"
        @if($editor_mode) data-section="courses" data-section-name="الدورات" data-editor-hidden="true" @endif
    >
        <div class="container-custom">
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-heading font-bold text-textDark mb-4">
                    دوراتنا التدريبية
                </h2>
                <p class="text-lg text-textMuted max-w-2xl mx-auto">
                    دورات متخصصة في التسويق الرقمي والإعلانات المدفوعة
                </p>
            </div>

            <!-- Course Cards Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8" id="courses-grid">
                @php
                    $coursesData = \App\Helpers\ContentHelper::getCourses();
                    // Ensure coursesData is always an array
                    if (!is_array($coursesData)) {
                        $coursesData = [];
                    }
                    // Filter only active courses and limit to 6
                    $coursesData = array_filter($coursesData, function($course) {
                        return isset($course['status']) && $course['status'] === 'active';
                    });
                    $coursesData = array_values(array_slice($coursesData, 0, 6));
                @endphp

                @forelse($coursesData as $course)
                    <div class="card course-card">
                        <div class="aspect-video rounded-xl mb-4 overflow-hidden">
                            @if(isset($course['image']) && $course['image'])
                                <img src="{{ asset('storage/' . $course['image']) }}" alt="{{ $course['title'] ?? 'صورة الدورة' }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center" style="background: linear-gradient(to bottom right, rgba(4, 194, 235, 0.8), rgba(4, 194, 235, 1));">
                                    <svg class="w-24 h-24 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="px-3 py-1 rounded-lg text-xs font-medium" style="background-color: rgba(4, 194, 235, 0.12); color: #111111;">
                                {{ $course['level'] ?? '' }}
                            </span>
                            <span class="font-bold text-lg" style="color: #04c2eb;">
                                {{ number_format($course['price'] ?? 0) }} <span class="text-sm font-normal" style="color: #6B6F73;">{{ $course['currency'] ?? 'جنيه' }}</span>
                            </span>
                        </div>
                        <h3 class="font-heading font-bold text-xl text-textDark mb-3">
                            {{ $course['title'] ?? '' }}
                        </h3>
                        <p class="text-sm text-textMuted mb-4 line-clamp-2">
                            {{ $course['short_description'] ?? '' }}
                        </p>
                        <div class="flex items-center gap-4 text-sm text-textMuted mb-4">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $course['duration'] ?? '' }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                {{ $course['lessons_count'] ?? 0 }} درس
                            </span>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ route('courses.show', $course['id']) }}" class="flex-1 text-center btn-primary text-sm">
                                {{ $course['primary_cta_text'] ?? 'اعرف التفاصيل' }}
                            </a>
                            <a href="{{ route('courses.show', $course['id']) }}" class="flex-1 text-center btn-outline text-sm">
                                {{ $course['secondary_cta_text'] ?? 'محتوى الكورس' }}
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-textMuted">لا توجد دورات متاحة حالياً</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('courses.index') }}" class="btn-primary">
                    عرض جميع الدورات
                </a>
            </div>
        </div>
    </section>

    <!-- Student Reviews Section -->
    <section 
        class="py-16 lg:py-24 bg-white section-editable"
        @if($editor_mode) data-section="reviews" data-section-name="تقييمات الطلاب" @endif
    >
        <div class="container-custom">
            <!-- Header -->
            <div class="text-center mb-12">
                <h2 
                    class="text-3xl lg:text-4xl font-heading font-bold text-textDark mb-4"
                    @if($editor_mode) data-editable="true" data-section="reviews" data-field="title.text" data-type="text" @endif
                >
                    {{ $reviews['title']['text'] ?? 'تقييمات الطلاب' }}
                </h2>
                <p 
                    class="text-lg text-textMuted"
                    @if($editor_mode) data-editable="true" data-section="reviews" data-field="subtitle.text" data-type="text" @endif
                >
                    {{ $reviews['subtitle']['text'] ?? 'ماذا قالوا عن ليرنن؟' }}
                </p>
            </div>

            <!-- Reviews Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @php
                    $reviewsList = $reviews['items'] ?? [];
                @endphp

                @foreach($reviewsList as $index => $review)
                    <div class="bg-white border-2 rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow duration-200" style="border-color: #E5E7EB;">
                        <!-- Review Text -->
                        <div class="mb-6">
                            <svg class="w-8 h-8 mb-4" style="color: #04c2eb; opacity: 0.3;" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.996 2.151c-3.313.785-5.461 3.022-5.461 6.849v4.808h4.479v7.2h-8.997zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-3.313.785-5.461 3.022-5.461 6.849v4.808h4.479v7.2h-8.997z"/>
                            </svg>
                            <p 
                                class="text-base text-textDark leading-relaxed"
                                @if($editor_mode) data-editable="true" data-section="reviews" data-field="items.{{ $index }}.text" data-type="text" @endif
                            >
                                {{ $review['text'] ?? '' }}
                            </p>
                        </div>

                        <!-- Reviewer Info -->
                        <div class="flex items-center gap-3 pt-4 border-t" style="border-color: #F5F6F7;">
                            <div class="w-12 h-12 rounded-full overflow-hidden flex items-center justify-center flex-shrink-0" style="background-color: rgba(4, 194, 235, 0.12);">
                                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="8" r="4" fill="#04c2eb"/>
                                    <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" stroke="#04c2eb" stroke-width="2" fill="none"/>
                                </svg>
                            </div>
                            <div>
                                <h3 
                                    class="font-heading font-bold text-base text-textDark"
                                    @if($editor_mode) data-editable="true" data-section="reviews" data-field="items.{{ $index }}.name" data-type="text" @endif
                                >
                                    {{ $review['name'] ?? '' }}
                                </h3>
                                <p 
                                    class="text-sm" 
                                    style="color: #6B6F73;"
                                    @if($editor_mode) data-editable="true" data-section="reviews" data-field="items.{{ $index }}.role" data-type="text" @endif
                                >
                                    {{ $review['role'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Banner Section -->
    <section 
        class="py-12 lg:py-16 section-editable" 
        style="background-color: {{ $banner['backgroundColor'] ?? 'rgba(4, 194, 235, 0.1)' }}; margin-bottom: 0; padding-bottom: 4rem;"
        @if($editor_mode) data-section="banner" data-section-name="بنر الدعوة" @endif
    >
        <div class="container-custom">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Left Side: Illustrations -->
                <div class="hidden lg:block">
                    <div class="relative">
                        <svg class="w-full max-w-md" viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Magnifying Glass -->
                            <circle cx="100" cy="80" r="40" stroke="#04c2eb" stroke-width="3" fill="none"/>
                            <path d="M130 110 L160 140" stroke="#04c2eb" stroke-width="3" stroke-linecap="round"/>
                            <!-- Book/Tablet -->
                            <rect x="200" y="60" width="80" height="100" rx="5" stroke="#04c2eb" stroke-width="3" fill="none"/>
                            <line x1="240" y1="80" x2="240" y2="140" stroke="#04c2eb" stroke-width="2"/>
                            <line x1="220" y1="100" x2="260" y2="100" stroke="#04c2eb" stroke-width="1.5"/>
                            <line x1="220" y1="120" x2="260" y2="120" stroke="#04c2eb" stroke-width="1.5"/>
                            <!-- Pencil -->
                            <path d="M320 50 L340 30 L350 40 L330 60 Z" fill="#04c2eb"/>
                            <line x1="335" y1="35" x2="335" y2="55" stroke="#FFFFFF" stroke-width="2"/>
                            <!-- Speech Bubbles -->
                            <ellipse cx="150" cy="200" rx="50" ry="40" stroke="#04c2eb" stroke-width="2" fill="none"/>
                            <ellipse cx="250" cy="220" rx="40" ry="35" stroke="#04c2eb" stroke-width="2" fill="none"/>
                            <circle cx="300" cy="180" r="25" stroke="#04c2eb" stroke-width="2" fill="none"/>
                            <!-- Dots in speech bubble -->
                            <circle cx="300" cy="180" r="3" fill="#04c2eb"/>
                            <circle cx="290" cy="175" r="2" fill="#04c2eb"/>
                            <circle cx="310" cy="185" r="2" fill="#04c2eb"/>
                        </svg>
                    </div>
                </div>

                <!-- Right Side: Text and CTA -->
                <div class="text-center lg:text-right">
                    <h2 
                        class="text-3xl lg:text-4xl xl:text-5xl font-heading font-bold mb-6 leading-tight text-textDark"
                        @if($editor_mode) data-editable="true" data-section="banner" data-field="title.text" data-type="text" @endif
                    >
                        {{ $banner['title']['text'] ?? 'لا تنتظر.. ابدأ رحلتك في التعلم مع ليرنن ديجيتال الآن!' }}
                    </h2>
                    
                    <!-- Features List -->
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center gap-3 justify-center lg:justify-start">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: rgba(4, 194, 235, 0.12);">
                                <svg class="w-6 h-6" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <span 
                                class="text-base font-medium text-textDark"
                                @if($editor_mode) data-editable="true" data-section="banner" data-field="feature1.text" data-type="text" @endif
                            >
                                {{ $banner['feature1']['text'] ?? 'مزايا انضمام Learn n\' Family' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-3 justify-center lg:justify-start">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: rgba(4, 194, 235, 0.12);">
                                <svg class="w-6 h-6" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                            <span 
                                class="text-base font-medium text-textDark"
                                @if($editor_mode) data-editable="true" data-section="banner" data-field="feature2.text" data-type="text" @endif
                            >
                                {{ $banner['feature2']['text'] ?? 'استرداد أموال بسهولة' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-3 justify-center lg:justify-start">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: rgba(4, 194, 235, 0.12);">
                                <svg class="w-6 h-6" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span 
                                class="text-base font-medium text-textDark"
                                @if($editor_mode) data-editable="true" data-section="banner" data-field="feature3.text" data-type="text" @endif
                            >
                                {{ $banner['feature3']['text'] ?? 'دعم 7/24 أيام' }}
                            </span>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a 
                            href="{{ $banner['button1']['link'] ?? route('courses.index') }}" 
                            class="btn-primary px-8 py-4 text-lg"
                            @if($editor_mode) data-editable="true" data-section="banner" data-field="button1.text" data-type="text" data-link-field="button1.link" @endif
                        >
                            {{ $banner['button1']['text'] ?? 'تصفح الكورسات' }}
                        </a>
                        <a 
                            href="{{ $banner['button2']['link'] ?? route('register') }}" 
                            class="btn-outline px-8 py-4 text-lg"
                            @if($editor_mode) data-editable="true" data-section="banner" data-field="button2.text" data-type="text" data-link-field="button2.link" @endif
                        >
                            {{ $banner['button2']['text'] ?? 'سجل معنا' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@if(!$isIncluded)
@endsection
@endif

