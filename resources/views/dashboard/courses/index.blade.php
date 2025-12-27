@extends('layouts.dashboard')

@section('title', 'إدارة الدورات')
@section('page-title', 'إدارة الدورات')
@section('page-description', 'عرض وإدارة جميع الدورات التدريبية')

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
        <a href="{{ route('dashboard.courses.create') }}" class="btn-primary inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            إضافة دورة جديدة
        </a>
    </div>

    <!-- Courses Table -->
    <div class="bg-white rounded-xl border-2 overflow-hidden" style="border-color: #111111;">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-bgSoft">
                    <tr>
                        <th class="px-6 py-4 text-right text-sm font-medium text-textDark">اسم الدورة</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-textDark">المستوى</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-textDark">المدة</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-textDark">الحالة</th>
                        <th class="px-6 py-4 text-right text-sm font-medium text-textDark">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y" style="border-color: #F5F6F7;">
                    @forelse($courses as $course)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="font-medium text-textDark">{{ $course['title'] ?? 'بدون عنوان' }}</div>
                                <div class="text-sm text-textMuted">{{ $course['description'] ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-lg text-sm font-medium" style="background-color: rgba(4, 194, 235, 0.12); color: #04c2eb;">
                                    {{ $course['level'] ?? 'غير محدد' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-textMuted">{{ $course['duration'] ?? 'غير محدد' }}</td>
                            <td class="px-6 py-4">
                                @if(($course['status'] ?? 'inactive') == 'active')
                                    <span class="px-3 py-1 rounded-lg text-sm font-medium bg-green-100 text-green-800">نشط</span>
                                @else
                                    <span class="px-3 py-1 rounded-lg text-sm font-medium bg-gray-100 text-gray-800">غير نشط</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('dashboard.courses.edit', $course['id']) }}" class="text-primary hover:text-primary/80">تعديل</a>
                                    <span class="text-textMuted">|</span>
                                    <form action="{{ route('dashboard.courses.destroy', $course['id']) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه الدورة؟');">
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                    <p class="text-lg font-medium mb-2">لا توجد دورات</p>
                                    <p class="text-sm">ابدأ بإضافة دورة جديدة</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

