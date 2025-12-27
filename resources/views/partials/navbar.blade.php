<nav class="sticky top-0 z-50 bg-white border-b shadow-sm" style="border-color: #F5F6F7;" role="navigation" aria-label="القائمة الرئيسية">
    <div class="container-custom">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center">
                    <span class="text-2xl font-heading font-bold text-textDark">منصة تعليمية</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex lg:items-center lg:space-x-reverse lg:space-x-8">
                <a href="{{ route('home') }}" class="text-textMuted hover:text-primary font-medium transition-colors duration-200 {{ request()->routeIs('home') ? 'text-primary' : '' }}" style="{{ request()->routeIs('home') ? 'color: #04c2eb;' : '' }}">
                    الرئيسية
                </a>
                
                <a href="{{ route('courses.index') }}" class="text-textMuted hover:text-primary font-medium transition-colors duration-200 {{ request()->routeIs('courses.*') ? 'text-primary' : '' }}" style="{{ request()->routeIs('courses.*') ? 'color: #04c2eb;' : '' }}">
                    الدورات
                </a>

                <a href="{{ route('about') }}" class="text-textMuted hover:text-primary font-medium transition-colors duration-200 {{ request()->routeIs('about') ? 'text-primary' : '' }}" style="{{ request()->routeIs('about') ? 'color: #04c2eb;' : '' }}">
                    عن المنصة
                </a>
                <a href="{{ route('blog.index') }}" class="text-textMuted hover:text-primary font-medium transition-colors duration-200 {{ request()->routeIs('blog.*') ? 'text-primary' : '' }}" style="{{ request()->routeIs('blog.*') ? 'color: #04c2eb;' : '' }}">
                    المدونة
                </a>
                <a href="{{ route('contact') }}" class="text-textMuted hover:text-primary font-medium transition-colors duration-200 mr-8 {{ request()->routeIs('contact') ? 'text-primary' : '' }}" style="{{ request()->routeIs('contact') ? 'color: #04c2eb;' : '' }}">
                    اتصل بنا
                </a>
            </div>

            <!-- Desktop Auth Buttons -->
            <div class="hidden lg:flex lg:items-center gap-3">
                @php
                    $settings = \App\Helpers\ContentHelper::getSiteSettings();
                    $whatsappNumber = $settings['whatsapp'] ?? '';
                @endphp
                @if($whatsappNumber && trim($whatsappNumber) !== '')
                    <a 
                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg transition-all duration-200 text-sm font-medium shadow-sm hover:shadow-md"
                        style="background-color: #25D366; color: #FFFFFF;"
                        onmouseover="this.style.backgroundColor='#128C7E'"
                        onmouseout="this.style.backgroundColor='#25D366'"
                        aria-label="تواصل معنا عبر واتساب"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.372a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                        واتساب
                    </a>
                @endif
                <a href="{{ route('register') }}" class="btn-primary text-sm">
                    انضم لينا
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button 
                class="lg:hidden p-2 rounded-lg focus:outline-none"
                style="color: #6B6F73;"
                onmouseover="this.style.backgroundColor='#F5F6F7'"
                onmouseout="this.style.backgroundColor='transparent'"
                onfocus="this.style.boxShadow='0 0 0 3px rgba(4, 194, 235, 0.3)'"
                onblur="this.style.boxShadow='none'"
                aria-label="فتح القائمة"
                aria-expanded="false"
                id="mobile-menu-button"
                type="button"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="menu-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="close-icon">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div 
        class="lg:hidden hidden border-t bg-white" 
        style="border-color: #F5F6F7;"
        id="mobile-menu"
        role="menu"
        aria-labelledby="mobile-menu-button"
    >
        <div class="container-custom py-4 space-y-4">
            <a href="{{ route('home') }}" class="block py-2 text-textMuted hover:text-primary font-medium transition-colors duration-200" style="{{ request()->routeIs('home') ? 'color: #04c2eb;' : '' }}">
                الرئيسية
            </a>
            <a href="{{ route('courses.index') }}" class="block py-2 text-textMuted hover:text-primary font-medium transition-colors duration-200" style="{{ request()->routeIs('courses.*') ? 'color: #04c2eb;' : '' }}">
                الدورات
            </a>
            <a href="{{ route('about') }}" class="block py-2 text-textMuted hover:text-primary font-medium transition-colors duration-200" style="{{ request()->routeIs('about') ? 'color: #04c2eb;' : '' }}">
                عن المنصة
            </a>
            <a href="{{ route('blog.index') }}" class="block py-2 text-textMuted hover:text-primary font-medium transition-colors duration-200" style="{{ request()->routeIs('blog.*') ? 'color: #04c2eb;' : '' }}">
                المدونة
            </a>
            <a href="{{ route('contact') }}" class="block py-2 text-textMuted hover:text-primary font-medium transition-colors duration-200" style="{{ request()->routeIs('contact') ? 'color: #04c2eb;' : '' }}">
                اتصل بنا
            </a>
            <div class="pt-4 border-t space-y-3" style="border-color: #F5F6F7;">
                @php
                    $settings = \App\Helpers\ContentHelper::getSiteSettings();
                    $whatsappNumber = $settings['whatsapp'] ?? '';
                @endphp
                @if($whatsappNumber && trim($whatsappNumber) !== '')
                    <a 
                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsappNumber) }}" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="flex items-center justify-center gap-2 w-full px-4 py-2 rounded-lg transition-all duration-200 text-sm font-medium shadow-sm hover:shadow-md"
                        style="background-color: #25D366; color: #FFFFFF;"
                        onmouseover="this.style.backgroundColor='#128C7E'"
                        onmouseout="this.style.backgroundColor='#25D366'"
                        aria-label="تواصل معنا عبر واتساب"
                    >
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.372a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                        واتساب
                    </a>
                @endif
                <a href="{{ route('register') }}" class="block w-full text-center btn-primary text-sm">
                    انضم لينا
                </a>
            </div>
        </div>
    </div>
</nav>

