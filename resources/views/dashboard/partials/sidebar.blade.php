<aside class="fixed right-0 top-0 h-full w-64 bg-white border-l shadow-lg z-40" style="border-color: #F5F6F7;">
    <div class="flex flex-col h-full">
        <!-- Logo -->
        <div class="p-6 border-b" style="border-color: #F5F6F7;">
            <a href="{{ route('dashboard.index') }}" class="flex items-center">
                <span class="text-xl font-heading font-bold text-textDark">Digital Hub Academy</span>
            </a>
            <p class="text-xs text-textMuted mt-1">لوحة التحكم</p>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <a 
                href="{{ route('dashboard.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-colors duration-200 {{ request()->routeIs('dashboard.index') ? 'bg-primary-tint-light text-primary' : 'text-textMuted hover:bg-bgSoft hover:text-textDark' }}"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                الرئيسية
            </a>

            <!-- Divider -->
            <div class="my-4 border-t" style="border-color: #F5F6F7;"></div>

            <!-- Content Pages Group -->
            <div class="space-y-2">
                <a 
                    href="{{ route('dashboard.homepage.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-colors duration-200 {{ request()->routeIs('dashboard.homepage.*') ? 'bg-primary-tint-light text-primary' : 'text-textMuted hover:bg-bgSoft hover:text-textDark' }}"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    الصفحة الرئيسية
                </a>

                <a 
                    href="{{ route('dashboard.about.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-colors duration-200 {{ request()->routeIs('dashboard.about.*') ? 'bg-primary-tint-light text-primary' : 'text-textMuted hover:bg-bgSoft hover:text-textDark' }}"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    عن المنصة
                </a>

                <a 
                    href="{{ route('dashboard.contact.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-colors duration-200 {{ request()->routeIs('dashboard.contact.*') ? 'bg-primary-tint-light text-primary' : 'text-textMuted hover:bg-bgSoft hover:text-textDark' }}"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    اتصل بنا
                </a>
            </div>

            <!-- Divider -->
            <div class="my-4 border-t" style="border-color: #F5F6F7;"></div>

            <a 
                href="{{ route('dashboard.courses.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-colors duration-200 {{ request()->routeIs('dashboard.courses.*') ? 'bg-primary-tint-light text-primary' : 'text-textMuted hover:bg-bgSoft hover:text-textDark' }}"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                الدورات
            </a>

            <a 
                href="{{ route('dashboard.blog.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-colors duration-200 {{ request()->routeIs('dashboard.blog.*') ? 'bg-primary-tint-light text-primary' : 'text-textMuted hover:bg-bgSoft hover:text-textDark' }}"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                المدونة
            </a>

            <a 
                href="{{ route('dashboard.settings') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-lg font-medium transition-colors duration-200 {{ request()->routeIs('dashboard.settings') ? 'bg-primary-tint-light text-primary' : 'text-textMuted hover:bg-bgSoft hover:text-textDark' }}"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                الإعدادات
            </a>
        </nav>

        <!-- User Section -->
        <div class="p-4 border-t" style="border-color: #F5F6F7;">
            <div class="flex items-center gap-3 px-4 py-3">
                <div class="w-10 h-10 rounded-full bg-primary-tint-light flex items-center justify-center">
                    <span class="text-primary font-bold text-sm">A</span>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-textDark">Admin</p>
                    <p class="text-xs text-textMuted">admin@example.com</p>
                </div>
            </div>
            <a href="{{ route('home') }}" class="w-full flex items-center gap-3 px-4 py-2 rounded-lg font-medium text-sm text-textMuted hover:bg-bgSoft hover:text-textDark transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                العودة للموقع
            </a>
        </div>
    </div>
</aside>

