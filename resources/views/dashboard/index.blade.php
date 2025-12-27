@extends('layouts.dashboard')

@section('title', 'لوحة التحكم')
@section('page-title', 'لوحة التحكم')
@section('page-description', 'نظرة عامة على إحصائيات الموقع')

@section('content')
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Courses -->
        <div class="bg-white rounded-xl p-6 border-2" style="border-color: #111111;">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-textMuted">إجمالي الدورات</h3>
                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: rgba(4, 194, 235, 0.12);">
                    <svg class="w-6 h-6" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-heading font-bold text-textDark">2</p>
            <p class="text-sm text-textMuted mt-2">دورة نشطة</p>
        </div>

        <!-- Total Blog Posts -->
        <div class="bg-white rounded-xl p-6 border-2" style="border-color: #111111;">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-textMuted">مقالات المدونة</h3>
                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: rgba(4, 194, 235, 0.12);">
                    <svg class="w-6 h-6" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-heading font-bold text-textDark">4</p>
            <p class="text-sm text-textMuted mt-2">مقال منشور</p>
        </div>

        <!-- Total Students -->
        <div class="bg-white rounded-xl p-6 border-2" style="border-color: #111111;">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-textMuted">إجمالي الطلاب</h3>
                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: rgba(4, 194, 235, 0.12);">
                    <svg class="w-6 h-6" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-heading font-bold text-textDark">0</p>
            <p class="text-sm text-textMuted mt-2">طالب مسجل</p>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-xl p-6 border-2" style="border-color: #111111;">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-textMuted">إجمالي الإيرادات</h3>
                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: rgba(4, 194, 235, 0.12);">
                    <svg class="w-6 h-6" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-heading font-bold text-textDark">0</p>
            <p class="text-sm text-textMuted mt-2">ريال سعودي</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Quick Actions Card -->
        <div class="bg-white rounded-xl p-6 border-2" style="border-color: #111111;">
            <h2 class="text-xl font-heading font-bold text-textDark mb-4">إجراءات سريعة</h2>
            <div class="space-y-3">
                <a href="{{ route('dashboard.courses.index') }}" class="flex items-center justify-between p-4 rounded-lg hover:bg-bgSoft transition-colors duration-200 border-2" style="border-color: #F5F6F7;">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background-color: rgba(4, 194, 235, 0.12);">
                            <svg class="w-5 h-5" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <span class="font-medium text-textDark">إضافة دورة جديدة</span>
                    </div>
                    <svg class="w-5 h-5 text-textMuted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <a href="{{ route('dashboard.blog.index') }}" class="flex items-center justify-between p-4 rounded-lg hover:bg-bgSoft transition-colors duration-200 border-2" style="border-color: #F5F6F7;">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background-color: rgba(4, 194, 235, 0.12);">
                            <svg class="w-5 h-5" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <span class="font-medium text-textDark">إضافة مقال جديد</span>
                    </div>
                    <svg class="w-5 h-5 text-textMuted" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Recent Activity Card -->
        <div class="bg-white rounded-xl p-6 border-2" style="border-color: #111111;">
            <h2 class="text-xl font-heading font-bold text-textDark mb-4">النشاط الأخير</h2>
            <div class="space-y-4">
                <div class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full mt-2" style="background-color: #04c2eb;"></div>
                    <div class="flex-1">
                        <p class="text-sm text-textDark">تم إنشاء دورة جديدة</p>
                        <p class="text-xs text-textMuted mt-1">منذ ساعتين</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-2 h-2 rounded-full mt-2" style="background-color: #04c2eb;"></div>
                    <div class="flex-1">
                        <p class="text-sm text-textDark">تم نشر مقال جديد</p>
                        <p class="text-xs text-textMuted mt-1">منذ 5 ساعات</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

