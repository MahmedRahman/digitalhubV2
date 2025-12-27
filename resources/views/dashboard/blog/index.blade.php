@extends('layouts.dashboard')

@section('title', 'إدارة المدونة')
@section('page-title', 'إدارة المدونة')
@section('page-description', 'عرض وإدارة جميع مقالات المدونة')

@section('content')
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
    
    <div class="mb-6">
        <a href="{{ route('dashboard.blog.create') }}" class="btn-primary inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            إضافة مقال جديد
        </a>
    </div>

    <!-- Blog Posts Table -->
    <div class="bg-white rounded-xl border-2 overflow-hidden" style="border-color: #111111;">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-bgSoft">
                    <tr>
                        <th class="px-6 py-4 text-right text-sm font-medium text-textDark">عنوان المقال</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-textDark">التصنيف</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-textDark">تاريخ النشر</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-textDark">الحالة</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-textDark">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y" style="border-color: #F5F6F7;">
                    @forelse($posts as $post)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="font-medium text-textDark">{{ $post['title'] ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 text-textMuted">{{ $post['category'] ?? '' }}</td>
                            <td class="px-6 py-4 text-textMuted">{{ $post['date'] ?? '' }}</td>
                            <td class="px-6 py-4">
                                @if(($post['status'] ?? '') === 'published')
                                    <span class="px-3 py-1 rounded-lg text-sm font-medium bg-green-100 text-green-800">منشور</span>
                                @else
                                    <span class="px-3 py-1 rounded-lg text-sm font-medium bg-yellow-100 text-yellow-800">مسودة</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('dashboard.blog.edit', $post['id']) }}" class="text-primary hover:text-primary/80">تعديل</a>
                                    <span class="text-textMuted">|</span>
                                    <form action="{{ route('dashboard.blog.destroy', $post['id']) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا المقال؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-textMuted hover:text-red-600">حذف</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="text-textMuted">
                                    <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                    </svg>
                                    <p class="text-lg font-medium mb-2">لا توجد مقالات</p>
                                    <p class="text-sm">ابدأ بإضافة مقال جديد</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

