@extends('layouts.app')

@section('title', 'المدونة')
@section('description', 'مقالات ونصائح تعليمية في مختلف المجالات')

@section('content')
    <div class="bg-white py-12 lg:py-16 border-b" style="border-color: #F5F6F7;">
        <div class="container-custom">
            <h1 class="text-3xl lg:text-4xl font-heading font-bold text-textDark mb-4">
                المدونة
            </h1>
            <p class="text-lg text-textMuted">
                مقالات ونصائح تعليمية في مختلف المجالات التقنية والمهنية
            </p>
        </div>
    </div>

    <section class="py-12 lg:py-16 bg-bgSoft">
        <div class="container-custom">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @forelse($posts as $post)
                    <article class="card hover:shadow-lg transition-shadow duration-200">
                        <a href="{{ route('blog.show', $post['id']) }}" class="block">
                            <div class="aspect-video rounded-xl mb-4 overflow-hidden">
                                @if(isset($post['image']) && $post['image'])
                                    <img src="{{ asset('storage/' . $post['image']) }}" alt="{{ $post['title'] ?? 'صورة المقال' }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center" style="background: linear-gradient(to bottom right, rgba(4, 194, 235, 0.8), rgba(4, 194, 235, 1));">
                                        <svg class="w-20 h-20 text-white opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <span class="px-3 py-1 rounded-lg text-xs font-medium" style="background-color: rgba(4, 194, 235, 0.12); color: #111111;">
                                    {{ $post['category'] }}
                                </span>
                            </div>
                            <h2 class="font-heading font-bold text-xl text-textDark mb-3 transition-colors duration-200" onmouseover="this.style.color='#04c2eb'" onmouseout="this.style.color='#111111'">
                                {{ $post['title'] }}
                            </h2>
                            <p class="text-textMuted text-sm mb-4 line-clamp-2">
                                {{ $post['excerpt'] }}
                            </p>
                            <div class="flex items-center justify-between text-xs" style="color: #6B6F73;">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $post['author'] ?? '' }}
                                </div>
                                <div class="flex items-center gap-4">
                                    <span>{{ $post['date'] ?? '' }}</span>
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $post['read_time'] ?? '5 دقائق' }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-24 h-24 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        <p class="text-lg font-medium text-textMuted mb-2">لا توجد مقالات متاحة حالياً</p>
                        <p class="text-sm text-textMuted">سيتم إضافة مقالات جديدة قريباً</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

