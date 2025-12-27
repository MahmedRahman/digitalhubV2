<nav class="sticky top-0 z-30 bg-white border-b shadow-sm" style="border-color: #F5F6F7;">
    <div class="flex items-center justify-between px-6 py-4">
        <div>
            <h1 class="text-xl font-heading font-bold text-textDark">@yield('page-title', 'لوحة التحكم')</h1>
            <p class="text-sm text-textMuted mt-1">@yield('page-description', '')</p>
        </div>
        
        <div class="flex items-center gap-4">
            <!-- Notifications (placeholder) -->
            <button class="p-2 rounded-lg text-textMuted hover:bg-bgSoft transition-colors duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
            </button>
        </div>
    </div>
</nav>

