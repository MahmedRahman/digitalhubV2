@extends('layouts.dashboard')

@section('title', 'الإعدادات')
@section('page-title', 'الإعدادات')
@section('page-description', 'إدارة إعدادات الموقع')

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
        
        <div class="bg-white rounded-xl p-6 border-2 mb-6" style="border-color: #111111;">
            <h2 class="text-xl font-heading font-bold text-textDark mb-4">إعدادات الموقع</h2>
            <p class="text-textMuted mb-6">إعدادات عامة للموقع</p>
            
            <form method="POST" action="{{ route('dashboard.settings.update') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="site_name" class="block text-sm font-medium text-textDark mb-2">اسم الموقع</label>
                    <input 
                        type="text" 
                        id="site_name"
                        name="site_name" 
                        value="{{ $settings['site_name'] ?? 'Digital Hub Academy' }}" 
                        required
                        class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                        style="border-color: #E5E7EB;"
                    >
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-textDark mb-2">البريد الإلكتروني</label>
                    <input 
                        type="email" 
                        id="email"
                        name="email" 
                        value="{{ $settings['email'] ?? 'info@example.com' }}" 
                        required
                        class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                        style="border-color: #E5E7EB;"
                    >
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-textDark mb-2">رقم الهاتف</label>
                    <input 
                        type="tel" 
                        id="phone"
                        name="phone" 
                        value="{{ $settings['phone'] ?? '+966 50 123 4567' }}" 
                        required
                        class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                        style="border-color: #E5E7EB;"
                    >
                </div>
                <div>
                    <label for="whatsapp" class="block text-sm font-medium text-textDark mb-2">
                        رقم واتساب <span class="text-xs text-textMuted font-normal">(لزر التواصل)</span>
                    </label>
                    <input 
                        type="tel" 
                        id="whatsapp"
                        name="whatsapp" 
                        value="{{ $settings['whatsapp'] ?? '+966501234567' }}" 
                        placeholder="مثال: +966501234567"
                        class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                        style="border-color: #E5E7EB;"
                    >
                    <p class="mt-1 text-xs text-textMuted">أدخل رقم واتساب بدون مسافات أو رموز (مثال: +966501234567)</p>
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-textDark mb-2">العنوان</label>
                    <textarea 
                        id="address"
                        name="address" 
                        rows="3"
                        required
                        class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors resize-none" 
                        style="border-color: #E5E7EB;"
                    >{{ $settings['address'] ?? 'الرياض، المملكة العربية السعودية' }}</textarea>
                </div>
                
                <div class="pt-6 border-t" style="border-color: #F5F6F7;">
                    <h3 class="text-lg font-heading font-bold text-textDark mb-4">وسائل التواصل الاجتماعي</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="youtube" class="block text-sm font-medium text-textDark mb-2">YouTube</label>
                            <input 
                                type="url" 
                                id="youtube"
                                name="social_media[youtube]" 
                                value="{{ $settings['social_media']['youtube'] ?? '' }}" 
                                placeholder="https://youtube.com/@channel"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                style="border-color: #E5E7EB;"
                            >
                        </div>
                        <div>
                            <label for="facebook" class="block text-sm font-medium text-textDark mb-2">Facebook</label>
                            <input 
                                type="url" 
                                id="facebook"
                                name="social_media[facebook]" 
                                value="{{ $settings['social_media']['facebook'] ?? '' }}" 
                                placeholder="https://facebook.com/page"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                style="border-color: #E5E7EB;"
                            >
                        </div>
                        <div>
                            <label for="instagram" class="block text-sm font-medium text-textDark mb-2">Instagram</label>
                            <input 
                                type="url" 
                                id="instagram"
                                name="social_media[instagram]" 
                                value="{{ $settings['social_media']['instagram'] ?? '' }}" 
                                placeholder="https://instagram.com/account"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                style="border-color: #E5E7EB;"
                            >
                        </div>
                        <div>
                            <label for="linkedin" class="block text-sm font-medium text-textDark mb-2">LinkedIn</label>
                            <input 
                                type="url" 
                                id="linkedin"
                                name="social_media[linkedin]" 
                                value="{{ $settings['social_media']['linkedin'] ?? '' }}" 
                                placeholder="https://linkedin.com/company/page"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                style="border-color: #E5E7EB;"
                            >
                        </div>
                        <div>
                            <label for="twitter" class="block text-sm font-medium text-textDark mb-2">Twitter / X</label>
                            <input 
                                type="url" 
                                id="twitter"
                                name="social_media[twitter]" 
                                value="{{ $settings['social_media']['twitter'] ?? '' }}" 
                                placeholder="https://twitter.com/account"
                                class="w-full px-4 py-3 border-2 rounded-lg focus:outline-none focus:border-primary transition-colors" 
                                style="border-color: #E5E7EB;"
                            >
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn-primary px-8 py-3">حفظ التغييرات</button>
            </form>
        </div>
    </div>
@endsection

