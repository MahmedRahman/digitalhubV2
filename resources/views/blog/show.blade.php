@extends('layouts.app')

@section('title', $post['title'] ?? 'المقال')
@section('description', $post['excerpt'] ?? '')

@section('content')
    <article class="py-12 lg:py-16 bg-white">
        <div class="container-custom">
            <div class="max-w-4xl mx-auto">
                <!-- Post Header -->
                <div class="mb-8">
                    <div class="mb-4">
                        <span class="px-3 py-1 rounded-lg text-sm font-medium" style="background-color: rgba(4, 194, 235, 0.12); color: #111111;">
                            {{ $post['category'] ?? '' }}
                        </span>
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-heading font-bold text-textDark mb-6">
                        {{ $post['title'] ?? '' }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-4 text-sm text-textMuted mb-6">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ $post['author'] ?? '' }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $post['date'] ?? '' }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $post['read_time'] ?? '5 دقائق' }}
                        </div>
                    </div>
                    @if(isset($post['image']) && $post['image'])
                        <div class="aspect-video rounded-2xl overflow-hidden mb-8">
                            <img src="{{ asset('storage/' . $post['image']) }}" alt="{{ $post['title'] ?? 'صورة المقال' }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="aspect-video rounded-2xl overflow-hidden mb-8 flex items-center justify-center" style="background: linear-gradient(to bottom right, rgba(4, 194, 235, 0.8), rgba(4, 194, 235, 1));">
                            <svg class="w-32 h-32 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Post Content -->
                <div class="prose prose-lg max-w-none leading-relaxed">
                    {!! $post['content'] ?? '<p>المحتوى غير متوفر</p>' !!}
                </div>

                <!-- CTA Section -->
                <div class="mt-12 p-8 rounded-2xl text-center" style="background-color: rgba(4, 194, 235, 0.08);">
                    <h3 class="text-2xl font-heading font-bold text-textDark mb-4">
                        ابدأ رحلتك التعليمية اليوم
                    </h3>
                    <p class="text-textMuted mb-6">
                        انضم إلى آلاف الطلاب الذين يطورون مهاراتهم معنا
                    </p>
                    <a href="{{ route('courses.index') }}" class="inline-block btn-primary">
                        تصفح الدورات
                    </a>
                </div>
            </div>
        </div>
    </article>
@endsection


