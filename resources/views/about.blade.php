@php
    $isIncluded = isset($isStandalone) && $isStandalone === false;
    $content = $content ?? \App\Helpers\ContentHelper::getAboutContent();
    $editor_mode = $editor_mode ?? false;
    $about_platform = $content['about_platform'] ?? [];
    $vision = $content['vision'] ?? [];
    $mission = $content['mission'] ?? [];
    $what_makes_us_special = $content['what_makes_us_special'] ?? [];
    $trainers = $content['trainers'] ?? [];
    $faq = $content['faq'] ?? [];
@endphp

@if(!$isIncluded)
@extends('layouts.app')

@section('title', 'عن المنصة')
@section('description', 'تعرف على منصتنا التعليمية ورؤيتنا ورسالتنا')

@section('content')
@endif
    <!-- About Platform Section -->
    <section 
        class="py-12 lg:py-16 bg-white section-editable"
        @if($editor_mode) data-section="about_platform" data-section-name="عن المنصة" @endif
    >
        <div class="container-custom">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Text Side (Right in RTL) -->
                <div class="text-center lg:text-right order-2 lg:order-1">
                    <h2 
                        class="text-2xl lg:text-3xl font-heading font-bold text-textDark mb-4"
                        @if($editor_mode) data-editable="true" data-section="about_platform" data-field="title.text" data-type="text" @endif
                    >
                        {{ $about_platform['title']['text'] ?? 'عن المنصة' }}
                    </h2>
                    <p 
                        class="text-base text-textMuted leading-relaxed"
                        @if($editor_mode) data-editable="true" data-section="about_platform" data-field="description.text" data-type="text" @endif
                    >
                        {{ $about_platform['description']['text'] ?? 'منصة تعليمية عربية متخصصة في تقديم دورات تدريبية عالية الجودة في مختلف المجالات التقنية والمهنية. نسعى لتمكين الأفراد من تطوير مهاراتهم ومعارفهم من خلال محتوى تعليمي شامل ومتخصص.' }}
                    </p>
                </div>
                
                <!-- Image Side (Left in RTL) -->
                <div class="order-1 lg:order-2">
                    <div class="aspect-video rounded-2xl overflow-hidden flex items-center justify-center" style="background: linear-gradient(135deg, rgba(4, 194, 235, 0.1), rgba(4, 194, 235, 0.2));">
                        <svg class="w-32 h-32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="#04c2eb" stroke-width="2" fill="none"/>
                            <path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke="#04c2eb" stroke-width="2" fill="none"/>
                            <path d="M12 2v20" stroke="#04c2eb" stroke-width="2"/>
                            <circle cx="12" cy="12" r="3" fill="#04c2eb"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Section -->
    <section 
        class="py-12 lg:py-16 bg-bgSoft section-editable"
        @if($editor_mode) data-section="vision" data-section-name="رؤيتنا" @endif
    >
        <div class="container-custom">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Image Side (Right in RTL) -->
                <div>
                    <div class="aspect-video rounded-2xl overflow-hidden flex items-center justify-center" style="background: linear-gradient(135deg, rgba(4, 194, 235, 0.1), rgba(4, 194, 235, 0.2));">
                        <svg class="w-32 h-32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="#04c2eb" stroke-width="2" fill="none"/>
                            <path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke="#04c2eb" stroke-width="2" fill="none"/>
                            <circle cx="12" cy="7" r="2" fill="#04c2eb"/>
                            <circle cx="12" cy="12" r="2" fill="#04c2eb"/>
                            <circle cx="12" cy="17" r="2" fill="#04c2eb"/>
                        </svg>
                    </div>
                </div>
                
                <!-- Text Side (Left in RTL) -->
                <div class="text-center lg:text-right">
                    <h2 
                        class="text-2xl lg:text-3xl font-heading font-bold text-textDark mb-4"
                        @if($editor_mode) data-editable="true" data-section="vision" data-field="title.text" data-type="text" @endif
                    >
                        {{ $vision['title']['text'] ?? 'رؤيتنا' }}
                    </h2>
                    <p 
                        class="text-base text-textMuted leading-relaxed"
                        @if($editor_mode) data-editable="true" data-section="vision" data-field="description.text" data-type="text" @endif
                    >
                        {{ $vision['description']['text'] ?? 'نطمح لأن نكون المنصة التعليمية العربية الرائدة في تقديم محتوى تعليمي عالي الجودة يلبي احتياجات المتعلمين في مختلف المجالات التقنية والمهنية. نسعى لبناء مجتمع تعليمي قوي يساهم في تطوير المهارات والمعارف.' }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section 
        class="py-12 lg:py-16 bg-white section-editable"
        @if($editor_mode) data-section="mission" data-section-name="رسالتنا" @endif
    >
        <div class="container-custom">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Text Side (Right in RTL) -->
                <div class="text-center lg:text-right order-2 lg:order-1">
                    <h2 
                        class="text-2xl lg:text-3xl font-heading font-bold text-textDark mb-4"
                        @if($editor_mode) data-editable="true" data-section="mission" data-field="title.text" data-type="text" @endif
                    >
                        {{ $mission['title']['text'] ?? 'رسالتنا' }}
                    </h2>
                    <p 
                        class="text-base text-textMuted leading-relaxed"
                        @if($editor_mode) data-editable="true" data-section="mission" data-field="description.text" data-type="text" @endif
                    >
                        {{ $mission['description']['text'] ?? 'نسعى إلى تمكين الأفراد من تطوير مهاراتهم ومعارفهم من خلال دورات تدريبية شاملة يقدمها خبراء في مجالاتهم. نؤمن بأن التعليم المستمر هو مفتاح النجاح في عالم اليوم المتغير بسرعة.' }}
                    </p>
                </div>
                
                <!-- Image Side (Left in RTL) -->
                <div class="order-1 lg:order-2">
                    <div class="aspect-video rounded-2xl overflow-hidden flex items-center justify-center" style="background: linear-gradient(135deg, rgba(4, 194, 235, 0.1), rgba(4, 194, 235, 0.2));">
                        <svg class="w-32 h-32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="#04c2eb" stroke-width="2" fill="none"/>
                            <path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke="#04c2eb" stroke-width="2" fill="none"/>
                            <path d="M8 10l4 4 8-8" stroke="#04c2eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What Makes Us Special Section -->
    <section 
        class="py-12 lg:py-16 bg-white section-editable"
        @if($editor_mode) data-section="what_makes_us_special" data-section-name="ما يميزنا" @endif
    >
        <div class="container-custom">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Left Side: Feature Cards Grid -->
                <div class="order-2 lg:order-1">
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Feature 1: Comprehensive Curriculum -->
                        <div class="bg-white border-2 rounded-xl p-5 text-center" style="border-color: #111111;">
                            <div class="mb-4">
                                <svg class="w-12 h-12 mx-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 2L3 14h8l-2 8 10-12h-8l2-8z" fill="#04c2eb" stroke="#111111" stroke-width="1.5"/>
                                </svg>
                            </div>
                            <h3 
                                class="font-heading font-bold text-base text-textDark mb-2"
                                @if($editor_mode) data-editable="true" data-section="what_makes_us_special" data-field="feature1.title" data-type="text" @endif
                            >
                                {{ $what_makes_us_special['feature1']['title'] ?? 'منهج شامل' }}
                            </h3>
                            <p 
                                class="text-xs text-textMuted leading-relaxed"
                                @if($editor_mode) data-editable="true" data-section="what_makes_us_special" data-field="feature1.description" data-type="text" @endif
                            >
                                {{ $what_makes_us_special['feature1']['description'] ?? 'صممت دوراتنا لتبدأ معك من المستوى المبتدئ لتصل بك إلى المستوى الاحترافي، وذلك من خلال اكتساب جميع المهارات اللازمة لذلك.' }}
                            </p>
                        </div>

                        <!-- Feature 2: Live and Interactive Courses -->
                        <div class="bg-white border-2 rounded-xl p-5 text-center" style="border-color: #111111;">
                            <div class="mb-4">
                                <svg class="w-12 h-12 mx-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="3" y="4" width="18" height="12" rx="2" stroke="#04c2eb" stroke-width="2" fill="none"/>
                                    <circle cx="12" cy="10" r="3" fill="#04c2eb"/>
                                    <path d="M7 16l5-3 5 3" stroke="#04c2eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10 6h4M10 8h4" stroke="#111111" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <h3 
                                class="font-heading font-bold text-base text-textDark mb-2"
                                @if($editor_mode) data-editable="true" data-section="what_makes_us_special" data-field="feature2.title" data-type="text" @endif
                            >
                                {{ $what_makes_us_special['feature2']['title'] ?? 'دورات مباشرة وتفاعلية' }}
                            </h3>
                            <p 
                                class="text-xs text-textMuted leading-relaxed"
                                @if($editor_mode) data-editable="true" data-section="what_makes_us_special" data-field="feature2.description" data-type="text" @endif
                            >
                                {{ $what_makes_us_special['feature2']['description'] ?? 'تفاعل مباشر مع المحاضرين والزملاء، لضمان تجربة تعلم مرنة وتعاونية.' }}
                            </p>
                        </div>

                        <!-- Feature 3: Professional Support -->
                        <div class="bg-white border-2 rounded-xl p-5 text-center" style="border-color: #111111;">
                            <div class="mb-4">
                                <svg class="w-12 h-12 mx-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="#F16B78" stroke="#111111" stroke-width="1.5"/>
                                    <path d="M8 12h8M8 16h6" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <h3 
                                class="font-heading font-bold text-base text-textDark mb-2"
                                @if($editor_mode) data-editable="true" data-section="what_makes_us_special" data-field="feature3.title" data-type="text" @endif
                            >
                                {{ $what_makes_us_special['feature3']['title'] ?? 'الدعم المهني والاستشارات' }}
                            </h3>
                            <p 
                                class="text-xs text-textMuted leading-relaxed"
                                @if($editor_mode) data-editable="true" data-section="what_makes_us_special" data-field="feature3.description" data-type="text" @endif
                            >
                                {{ $what_makes_us_special['feature3']['description'] ?? 'نقدم دعم فني واستشارات لطلابنا لمساعدتهم على تخطي التحديات المهنية في سوق العمل.' }}
                            </p>
                        </div>

                        <!-- Feature 4: Practical Projects -->
                        <div class="bg-white border-2 rounded-xl p-5 text-center" style="border-color: #111111;">
                            <div class="mb-4">
                                <svg class="w-12 h-12 mx-auto" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z" stroke="#04c2eb" stroke-width="2" fill="none"/>
                                    <path d="M2 17l10 5 10-5M2 12l10 5 10-5" stroke="#04c2eb" stroke-width="2" fill="none"/>
                                    <path d="M12 2v20" stroke="#04c2eb" stroke-width="2"/>
                                    <path d="M8 6l4 4 4-4" stroke="#111111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                                </svg>
                            </div>
                            <h3 
                                class="font-heading font-bold text-base text-textDark mb-2"
                                @if($editor_mode) data-editable="true" data-section="what_makes_us_special" data-field="feature4.title" data-type="text" @endif
                            >
                                {{ $what_makes_us_special['feature4']['title'] ?? 'مشاريع عملية' }}
                            </h3>
                            <p 
                                class="text-xs text-textMuted leading-relaxed"
                                @if($editor_mode) data-editable="true" data-section="what_makes_us_special" data-field="feature4.description" data-type="text" @endif
                            >
                                {{ $what_makes_us_special['feature4']['description'] ?? 'من خلال تطبيق المحتوى النظري الذي تعلمته إلى مهام عملية وواقعية.' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Text and CTA -->
                <div class="text-center lg:text-right order-1 lg:order-2">
                    <div class="inline-block px-4 py-2 rounded-lg mb-4" style="background-color: rgba(4, 194, 235, 0.12);">
                        <span 
                            class="text-sm font-medium" 
                            style="color: #04c2eb;"
                            @if($editor_mode) data-editable="true" data-section="what_makes_us_special" data-field="badge.text" data-type="text" @endif
                        >
                            {{ $what_makes_us_special['badge']['text'] ?? 'ما يميزنا' }}
                        </span>
                    </div>
                    <h2 
                        class="text-3xl lg:text-4xl xl:text-5xl font-heading font-bold mb-6 leading-tight text-textDark"
                        @if($editor_mode) data-editable="true" data-section="what_makes_us_special" data-field="title.text" data-type="text" @endif
                    >
                        {{ $what_makes_us_special['title']['text'] ?? 'نقدم محتوى تفاعلي مباشر بشكل عملي لطلابنا!' }}
                    </h2>
                    <p 
                        class="text-base lg:text-lg text-textMuted mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0"
                        @if($editor_mode) data-editable="true" data-section="what_makes_us_special" data-field="description.text" data-type="text" @endif
                    >
                        {{ $what_makes_us_special['description']['text'] ?? 'إكتسب مهارات عملية ومعرفة عميقة من خلال دوراتنا المباشرة والتفاعلية التي تربط بدورها بين الدراسة النظرية والتطبيق العملي.' }}
                    </p>
                    <a 
                        href="{{ $what_makes_us_special['button']['link'] ?? route('courses.index') }}" 
                        class="btn-primary px-8 py-4 text-lg"
                        @if($editor_mode) data-editable="true" data-section="what_makes_us_special" data-field="button.text" data-type="text" data-link-field="button.link" @endif
                    >
                        {{ $what_makes_us_special['button']['text'] ?? 'تعلم معنا' }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Trainers Section -->
    <section 
        class="py-12 lg:py-16 bg-white section-editable"
        @if($editor_mode) data-section="trainers" data-section-name="المدربين" @endif
    >
        <div class="container-custom">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Left Side: Text Content -->
                <div class="text-center lg:text-right order-2 lg:order-1">
                    <div class="inline-block px-3 py-1 rounded-lg mb-4" style="background-color: rgba(4, 194, 235, 0.12);">
                        <span 
                            class="text-sm font-medium" 
                            style="color: #04c2eb;"
                            @if($editor_mode) data-editable="true" data-section="trainers" data-field="badge.text" data-type="text" @endif
                        >
                            {{ $trainers['badge']['text'] ?? 'المدربين' }}
                        </span>
                    </div>
                    <h2 
                        class="text-3xl lg:text-4xl font-heading font-bold text-textDark mb-6"
                        @if($editor_mode) data-editable="true" data-section="trainers" data-field="title.text" data-type="text" @endif
                    >
                        {{ $trainers['title']['text'] ?? 'محاضرينا على أعلى مستوى من الاحترافية' }}
                    </h2>
                    <p 
                        class="text-base lg:text-lg text-textMuted leading-relaxed mb-6"
                        @if($editor_mode) data-editable="true" data-section="trainers" data-field="description.text" data-type="text" @endif
                    >
                        {{ $trainers['description']['text'] ?? 'محاضرينا أكثر من كونهم معلمين، فهم محترفون يمتلكون سنوات من الخبرة في مجال التسويق الرقمي. يقدم المحاضرون معرفتهم الواسعة وخبرتهم العملية لتقديم تجربة تعليمية غنية لجميع المتدربين. ويمتلك المحاضرون سجل مثبت من النجاح في مجالات تخصصهم، ويكرسون جهودهم لمساعدة المتعلمين على تحقيق أهدافهم.' }}
                    </p>
                </div>

                <!-- Right Side: Trainer Photos -->
                <div class="order-1 lg:order-2">
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Trainer 1 -->
                        <div class="relative">
                            <div class="aspect-square rounded-xl overflow-hidden border-2" style="border-color: #111111; background-color: rgba(4, 194, 235, 0.1);">
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-24 h-24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="8" r="4" fill="#04c2eb"/>
                                        <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" stroke="#04c2eb" stroke-width="2" fill="none"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- Trainer 2 -->
                        <div class="relative mt-8">
                            <div class="aspect-square rounded-xl overflow-hidden border-2" style="border-color: #111111; background-color: rgba(4, 194, 235, 0.1);">
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-24 h-24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="8" r="4" fill="#04c2eb"/>
                                        <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" stroke="#04c2eb" stroke-width="2" fill="none"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- Trainer 3 -->
                        <div class="relative col-span-2">
                            <div class="aspect-square rounded-xl overflow-hidden border-2 max-w-xs mx-auto" style="border-color: #111111; background-color: rgba(4, 194, 235, 0.1);">
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-24 h-24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="8" r="4" fill="#04c2eb"/>
                                        <path d="M6 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" stroke="#04c2eb" stroke-width="2" fill="none"/>
                                    </svg>
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
        class="py-8 lg:py-12 bg-white section-editable"
        @if($editor_mode) data-section="faq" data-section-name="أسئلة شائعة" @endif
    >
        <div class="container-custom">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12">
                <!-- Left Column: CTA -->
                <div class="flex flex-col justify-center order-2 lg:order-1">
                    <div class="mb-3">
                        <span 
                            class="text-sm font-medium" 
                            style="color: #04c2eb;"
                            @if($editor_mode) data-editable="true" data-section="faq" data-field="badge.text" data-type="text" @endif
                        >
                            {{ $faq['badge']['text'] ?? 'أسئلة شائعة' }}
                        </span>
                    </div>
                    <h2 
                        class="text-3xl lg:text-4xl font-heading font-bold text-textDark mb-6"
                        @if($editor_mode) data-editable="true" data-section="faq" data-field="title.text" data-type="text" @endif
                    >
                        {!! $faq['title']['text'] ?? 'هل لديك أي استفسارات؟<br>يُمكنك إيجاد الإجابة هنا' !!}
                    </h2>
                    <a 
                        href="{{ $faq['button']['link'] ?? route('courses.index') }}" 
                        class="inline-block px-8 py-4 rounded-xl font-medium text-lg transition-all duration-200 text-center btn-primary"
                        @if($editor_mode) data-editable="true" data-section="faq" data-field="button.text" data-type="text" data-link-field="button.link" @endif
                    >
                        {{ $faq['button']['text'] ?? 'تعلم معنا' }}
                    </a>
                </div>

                <!-- Right Column: FAQ Questions -->
                <div class="order-1 lg:order-2">
                    <div class="space-y-3">
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
                                        class="flex-1 text-right font-medium text-textDark"
                                        @if($editor_mode) data-editable="true" data-section="faq" data-field="items.{{ $index }}.question" data-type="text" @endif
                                    >
                                        {{ $faqItem['question'] ?? '' }}
                                    </span>
                                    <svg 
                                        class="w-5 h-5 transition-transform duration-300 transform flex-shrink-0 mr-3"
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
                                    <div class="px-4 pt-4 pb-4" style="background-color: #FFFFFF;">
                                        <p 
                                            class="text-sm text-textMuted leading-relaxed"
                                            @if($editor_mode) data-editable="true" data-section="faq" data-field="items.{{ $index }}.answer" data-type="text" @endif
                                        >
                                            {{ $faqItem['answer'] ?? '' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@if(!$isIncluded)
@endsection
@endif

