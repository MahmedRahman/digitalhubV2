@php
    $isIncluded = isset($isStandalone) && $isStandalone === false;
    $content = $content ?? \App\Helpers\ContentHelper::getContactContent();
    $editor_mode = $editor_mode ?? false;
    $hero = $content['hero'] ?? [];
    $form = $content['form'] ?? [];
    $contact_info = $content['contact_info'] ?? [];
    $faq = $content['faq'] ?? [];
    $settings = \App\Helpers\ContentHelper::getSiteSettings();
@endphp

@if(!$isIncluded)
@extends('layouts.app')

@section('title', 'اتصل بنا')
@section('description', 'تواصل معنا لأي استفسارات أو مساعدة')

@section('content')
@endif
    <!-- Hero Section -->
    <div 
        class="bg-white py-12 lg:py-16 border-b section-editable" 
        style="border-color: #F5F6F7;"
        @if($editor_mode) data-section="hero" data-section-name="Hero Section" @endif
    >
        <div class="container-custom">
            <div class="text-center max-w-3xl mx-auto">
                <h1 
                    class="text-3xl lg:text-4xl font-heading font-bold text-textDark mb-4"
                    @if($editor_mode) data-editable="true" data-section="hero" data-field="title.text" data-type="text" @endif
                >
                    {{ $hero['title']['text'] ?? 'تواصل معنا' }}
                </h1>
                <p 
                    class="text-lg text-textMuted leading-relaxed"
                    @if($editor_mode) data-editable="true" data-section="hero" data-field="description.text" data-type="text" @endif
                >
                    {{ $hero['description']['text'] ?? 'نحن هنا لمساعدتك. تواصل معنا لأي استفسارات أو مساعدة، وسنكون سعداء بالرد عليك في أقرب وقت ممكن.' }}
                </p>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <section class="py-12 lg:py-16 bg-bgSoft">
        <div class="container-custom">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12">
                <!-- Contact Form -->
                <div 
                    class="bg-white rounded-2xl p-6 lg:p-8 shadow-sm section-editable"
                    @if($editor_mode) data-section="form" data-section-name="نموذج التواصل" @endif
                >
                    <h2 
                        class="text-2xl lg:text-3xl font-heading font-bold text-textDark mb-6"
                        @if($editor_mode) data-editable="true" data-section="form" data-field="title.text" data-type="text" @endif
                    >
                        {{ $form['title']['text'] ?? 'أرسل لنا رسالة' }}
                    </h2>
                    <p 
                        class="text-base text-textMuted mb-6"
                        @if($editor_mode) data-editable="true" data-section="form" data-field="description.text" data-type="text" @endif
                    >
                        {{ $form['description']['text'] ?? 'املأ النموذج أدناه وسنتواصل معك في أقرب وقت ممكن.' }}
                    </p>
                    <form class="space-y-5" method="POST" action="#">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium mb-2 text-textDark">
                                الاسم الكامل
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                required
                                placeholder="أدخل اسمك الكامل"
                                class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none transition-all duration-200"
                                style="border-color: #E5E7EB; background-color: #FFFFFF;"
                                onfocus="this.style.borderColor='#04c2eb'; this.style.boxShadow='0 0 0 3px rgba(4, 194, 235, 0.1)'"
                                onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none'"
                            >
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium mb-2 text-textDark">
                                البريد الإلكتروني
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                required
                                placeholder="example@email.com"
                                class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none transition-all duration-200"
                                style="border-color: #E5E7EB; background-color: #FFFFFF;"
                                onfocus="this.style.borderColor='#04c2eb'; this.style.boxShadow='0 0 0 3px rgba(4, 194, 235, 0.1)'"
                                onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none'"
                            >
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium mb-2 text-textDark">
                                الموضوع
                            </label>
                            <input 
                                type="text" 
                                id="subject" 
                                name="subject" 
                                required
                                placeholder="ما هو موضوع استفسارك؟"
                                class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none transition-all duration-200"
                                style="border-color: #E5E7EB; background-color: #FFFFFF;"
                                onfocus="this.style.borderColor='#04c2eb'; this.style.boxShadow='0 0 0 3px rgba(4, 194, 235, 0.1)'"
                                onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none'"
                            >
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium mb-2 text-textDark">
                                الرسالة
                            </label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="6" 
                                required
                                placeholder="اكتب رسالتك هنا..."
                                class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none transition-all duration-200 resize-none"
                                style="border-color: #E5E7EB; background-color: #FFFFFF;"
                                onfocus="this.style.borderColor='#04c2eb'; this.style.boxShadow='0 0 0 3px rgba(4, 194, 235, 0.1)'"
                                onblur="this.style.borderColor='#E5E7EB'; this.style.boxShadow='none'"
                            ></textarea>
                        </div>
                        <button type="submit" class="btn-primary w-full py-4 text-lg">
                            إرسال الرسالة
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div 
                    class="space-y-8 section-editable"
                    @if($editor_mode) data-section="contact_info" data-section-name="معلومات التواصل" @endif
                >
                    <!-- Contact Information Cards -->
                    <div>
                        <h2 
                            class="text-2xl lg:text-3xl font-heading font-bold text-textDark mb-6"
                            @if($editor_mode) data-editable="true" data-section="contact_info" data-field="title.text" data-type="text" @endif
                        >
                            {{ $contact_info['title']['text'] ?? 'معلومات التواصل' }}
                        </h2>
                        <div class="space-y-4">
                            <!-- Email Card -->
                            <div class="bg-white rounded-xl p-5 border-2 shadow-sm hover:shadow-md transition-shadow duration-200" style="border-color: #E5E7EB;">
                                <div class="flex items-start gap-4">
                                    <div class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color: rgba(4, 194, 235, 0.12);">
                                        <svg class="w-7 h-7" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 
                                            class="font-heading font-bold text-lg text-textDark mb-2"
                                            @if($editor_mode) data-editable="true" data-section="contact_info" data-field="email.label" data-type="text" @endif
                                        >
                                            {{ $contact_info['email']['label'] ?? 'البريد الإلكتروني' }}
                                        </h3>
                                        <a 
                                            href="mailto:{{ $contact_info['email']['value'] ?? $settings['email'] ?? 'info@example.com' }}" 
                                            class="text-textMuted hover:text-primary transition-colors duration-200"
                                            @if($editor_mode) data-editable="true" data-section="contact_info" data-field="email.value" data-type="text" @endif
                                        >
                                            {{ $contact_info['email']['value'] ?? $settings['email'] ?? 'info@example.com' }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Phone Card -->
                            <div class="bg-white rounded-xl p-5 border-2 shadow-sm hover:shadow-md transition-shadow duration-200" style="border-color: #E5E7EB;">
                                <div class="flex items-start gap-4">
                                    <div class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color: rgba(4, 194, 235, 0.12);">
                                        <svg class="w-7 h-7" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 
                                            class="font-heading font-bold text-lg text-textDark mb-2"
                                            @if($editor_mode) data-editable="true" data-section="contact_info" data-field="phone.label" data-type="text" @endif
                                        >
                                            {{ $contact_info['phone']['label'] ?? 'الهاتف' }}
                                        </h3>
                                        <a 
                                            href="tel:{{ str_replace(' ', '', $contact_info['phone']['value'] ?? $settings['phone'] ?? '+966501234567') }}" 
                                            class="text-textMuted hover:text-primary transition-colors duration-200"
                                            @if($editor_mode) data-editable="true" data-section="contact_info" data-field="phone.value" data-type="text" @endif
                                        >
                                            {{ $contact_info['phone']['value'] ?? $settings['phone'] ?? '+966 50 123 4567' }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Location Card -->
                            <div class="bg-white rounded-xl p-5 border-2 shadow-sm hover:shadow-md transition-shadow duration-200" style="border-color: #E5E7EB;">
                                <div class="flex items-start gap-4">
                                    <div class="w-14 h-14 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color: rgba(4, 194, 235, 0.12);">
                                        <svg class="w-7 h-7" style="color: #04c2eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h3 
                                            class="font-heading font-bold text-lg text-textDark mb-2"
                                            @if($editor_mode) data-editable="true" data-section="contact_info" data-field="address.label" data-type="text" @endif
                                        >
                                            {{ $contact_info['address']['label'] ?? 'العنوان' }}
                                        </h3>
                                        <p 
                                            class="text-textMuted"
                                            @if($editor_mode) data-editable="true" data-section="contact_info" data-field="address.value" data-type="text" @endif
                                        >
                                            {{ $contact_info['address']['value'] ?? $settings['address'] ?? 'الرياض، المملكة العربية السعودية' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section 
        class="py-12 lg:py-16 bg-white section-editable"
        @if($editor_mode) data-section="faq" data-section-name="الأسئلة الشائعة" @endif
    >
        <div class="container-custom">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-8">
                    <h2 
                        class="text-2xl lg:text-3xl font-heading font-bold text-textDark mb-4"
                        @if($editor_mode) data-editable="true" data-section="faq" data-field="title.text" data-type="text" @endif
                    >
                        {{ $faq['title']['text'] ?? 'الأسئلة الشائعة' }}
                    </h2>
                    <p 
                        class="text-base text-textMuted"
                        @if($editor_mode) data-editable="true" data-section="faq" data-field="description.text" data-type="text" @endif
                    >
                        {{ $faq['description']['text'] ?? 'إجابات على الأسئلة الأكثر شيوعاً' }}
                    </p>
                </div>
                <div class="space-y-3" id="faq-accordion">
                    @php
                        $faqs = $faq['items'] ?? [];
                    @endphp

                    @foreach($faqs as $index => $faqItem)
                        <div class="accordion-item border-2 rounded-lg overflow-hidden bg-white" style="border-color: #E5E7EB;">
                            <button 
                                class="w-full flex items-center justify-between text-right p-4 focus:outline-none"
                                style="focus:ring-2; focus:ring-color: rgba(4, 194, 235, 0.3);"
                                aria-expanded="false"
                                aria-controls="faq-{{ $index }}"
                                id="faq-button-{{ $index }}"
                                type="button"
                            >
                                <span 
                                    class="flex-1 text-right font-medium text-textDark text-base"
                                    @if($editor_mode) data-editable="true" data-section="faq" data-field="items.{{ $index }}.question" data-type="text" @endif
                                >
                                    {{ $faqItem['question'] ?? '' }}
                                </span>
                                <svg 
                                    class="w-6 h-6 transition-transform duration-300 transform flex-shrink-0 mr-3"
                                    style="color: #6B6F73;"
                                    fill="none" 
                                    stroke="currentColor" 
                                    viewBox="0 0 24 24"
                                    id="faq-icon-{{ $index }}"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div 
                                class="hidden overflow-hidden"
                                id="faq-{{ $index }}"
                                role="region"
                                aria-labelledby="faq-button-{{ $index }}"
                                style="max-height: 0; opacity: 0;"
                            >
                                <div 
                                    class="px-4 pt-4 pb-4 text-textMuted leading-relaxed"
                                    @if($editor_mode) data-editable="true" data-section="faq" data-field="items.{{ $index }}.answer" data-type="text" @endif
                                >
                                    {{ $faqItem['answer'] ?? '' }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@if(!$isIncluded)
@endsection
@endif
