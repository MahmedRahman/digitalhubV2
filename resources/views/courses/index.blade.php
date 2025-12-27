@extends('layouts.app')

@section('title', 'الدورات التدريبية')
@section('description', 'استكشف مجموعة واسعة من الدورات التدريبية في مختلف المجالات')

@section('content')
    <!-- Newsletter Subscription Banner -->
    <section class="py-12 lg:py-16" style="background-color: rgba(4, 194, 235, 0.1);">
        <div class="container-custom">
            <div class="max-w-3xl mx-auto">
                <!-- Central Content -->
                <div class="text-center px-4">
                    <h2 class="text-4xl lg:text-5xl font-heading font-bold text-textDark mb-4">
                        الدورات
                    </h2>
                    <p class="text-lg lg:text-xl text-textMuted mb-2">
                        تصفح آخر الدورات
                    </p>
                    <p class="text-lg lg:text-xl text-textMuted mb-8">
                        الاشتراك في القائمة البريدية
                    </p>
                    
                    <!-- Email Subscription Form -->
                    <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto" method="POST" action="#">
                        @csrf
                        <div class="flex-1 relative">
                            <input 
                                type="email" 
                                name="email" 
                                placeholder="البريد الإلكتروني"
                                required
                                class="w-full px-4 py-3 pr-12 border-2 rounded-xl focus:outline-none transition-all duration-200"
                                style="border-color: #111111; background-color: #FFFFFF;"
                                onfocus="this.style.borderColor='#04c2eb'; this.style.boxShadow='0 0 0 3px rgba(4, 194, 235, 0.2)'"
                                onblur="this.style.borderColor='#111111'; this.style.boxShadow='none'"
                            >
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5" style="color: #6B6F73;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <button 
                            type="submit" 
                            class="px-8 py-3 rounded-xl font-medium text-base transition-all duration-200 whitespace-nowrap"
                            style="background-color: rgba(4, 194, 235, 0.1); color: #111111; border: 2px solid #111111;"
                            onmouseover="this.style.backgroundColor='#04c2eb'; this.style.color='#FFFFFF'"
                            onmouseout="this.style.backgroundColor='rgba(4, 194, 235, 0.1)'; this.style.color='#111111'"
                        >
                            إشترك
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 lg:py-16 bg-white">
        <div class="container-custom">
            <!-- Course Cards Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8" id="courses-grid">
                @forelse($courses as $course)
                    <a href="{{ route('courses.show', $course['id']) }}" class="card course-card block">
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
                        <div class="btn-primary text-center text-sm">
                            {{ $course['primary_cta_text'] ?? 'اعرف التفاصيل' }}
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-24 h-24 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <p class="text-lg font-medium text-textMuted mb-2">لا توجد دورات متاحة حالياً</p>
                        <p class="text-sm text-textMuted">سيتم إضافة دورات جديدة قريباً</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Banner Section -->
    <section class="py-12 lg:py-16" style="background-color: rgba(4, 194, 235, 0.1);">
        <div class="container-custom">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Left Side: Illustrations -->
                <div class="hidden lg:block">
                    <div class="relative">
                        <svg class="w-full max-w-md" viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Magnifying Glass -->
                            <circle cx="100" cy="80" r="40" stroke="#111111" stroke-width="3" fill="none"/>
                            <path d="M130 110 L160 140" stroke="#111111" stroke-width="3" stroke-linecap="round"/>
                            <!-- Book/Tablet -->
                            <rect x="200" y="60" width="80" height="100" rx="5" stroke="#111111" stroke-width="3" fill="none"/>
                            <line x1="240" y1="80" x2="240" y2="140" stroke="#111111" stroke-width="2"/>
                            <line x1="220" y1="100" x2="260" y2="100" stroke="#111111" stroke-width="1.5"/>
                            <line x1="220" y1="120" x2="260" y2="120" stroke="#111111" stroke-width="1.5"/>
                            <!-- Pencil -->
                            <path d="M320 50 L340 30 L350 40 L330 60 Z" fill="#111111"/>
                            <line x1="335" y1="35" x2="335" y2="55" stroke="#FFFFFF" stroke-width="2"/>
                            <!-- Speech Bubbles -->
                            <ellipse cx="150" cy="200" rx="50" ry="40" stroke="#111111" stroke-width="2" fill="none"/>
                            <ellipse cx="250" cy="220" rx="40" ry="35" stroke="#111111" stroke-width="2" fill="none"/>
                            <circle cx="300" cy="180" r="25" stroke="#111111" stroke-width="2" fill="none"/>
                            <!-- Dots in speech bubble -->
                            <circle cx="300" cy="180" r="3" fill="#111111"/>
                            <circle cx="290" cy="175" r="2" fill="#111111"/>
                            <circle cx="310" cy="185" r="2" fill="#111111"/>
                        </svg>
                    </div>
                </div>

                <!-- Right Side: Text and CTA -->
                <div class="text-center lg:text-right">
                    <h2 class="text-3xl lg:text-4xl xl:text-5xl font-heading font-bold mb-6 leading-tight text-textDark">
                        لا تنتظر.. ابدأ رحلتك في التعلم مع ليرنن ديجيتال الآن!
                    </h2>
                    
                    <!-- Features List -->
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center gap-3 justify-center lg:justify-start">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: rgba(4, 194, 235, 0.12);">
                                <svg class="w-6 h-6" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <span class="text-base font-medium text-textDark">مزايا انضمام Learn n' Family</span>
                        </div>
                        <div class="flex items-center gap-3 justify-center lg:justify-start">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: rgba(4, 194, 235, 0.12);">
                                <svg class="w-6 h-6" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </div>
                            <span class="text-base font-medium text-textDark">استرداد أموال بسهولة</span>
                        </div>
                        <div class="flex items-center gap-3 justify-center lg:justify-start">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: rgba(4, 194, 235, 0.12);">
                                <svg class="w-6 h-6" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-base font-medium text-textDark">دعم 7/24 أيام</span>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('courses.index') }}" class="btn-primary px-8 py-4 text-lg">
                            تصفح الكورسات
                        </a>
                        <a href="{{ route('register') }}" class="btn-outline px-8 py-4 text-lg" style="border-color: #111111;">
                            سجل معنا
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

