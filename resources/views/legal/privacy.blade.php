@extends('layouts.app')

@section('title', 'سياسة الخصوصية')
@section('description', 'سياسة الخصوصية الخاصة بمنصتنا التعليمية')

@section('content')
    <div class="bg-white py-12 lg:py-16 border-b" style="border-color: #F5F6F7;">
        <div class="container-custom">
            <h1 class="text-3xl lg:text-4xl font-heading font-bold text-textDark mb-4">
                سياسة الخصوصية
            </h1>
            <p class="text-lg text-textMuted">
                آخر تحديث: {{ date('Y-m-d') }}
            </p>
        </div>
    </div>

    <section class="py-12 lg:py-16 bg-white">
        <div class="container-custom">
            <div class="max-w-3xl mx-auto">
                <div class="prose prose-lg max-w-none leading-relaxed">
                    <h2 class="text-2xl font-heading font-bold text-textDark mb-4">مقدمة</h2>
                    <p class="mb-6">
                        نحن ملتزمون بحماية خصوصيتك. توضح سياسة الخصوصية هذه كيفية جمع واستخدام وحماية معلوماتك الشخصية عند استخدام منصتنا التعليمية.
                    </p>

                    <h2 class="text-2xl font-heading font-bold text-textDark mb-4 mt-8">المعلومات التي نجمعها</h2>
                    <p class="mb-4">نجمع المعلومات التالية:</p>
                    <ul class="list-disc list-inside space-y-2 mb-6">
                        <li>الاسم والبريد الإلكتروني عند التسجيل</li>
                        <li>معلومات الدفع عند الشراء</li>
                        <li>سجل التقدم في الدورات</li>
                        <li>معلومات الاستخدام والتفاعل مع المنصة</li>
                    </ul>

                    <h2 class="text-2xl font-heading font-bold text-textDark mb-4 mt-8">كيف نستخدم معلوماتك</h2>
                    <p class="mb-4">نستخدم معلوماتك لـ:</p>
                    <ul class="list-disc list-inside space-y-2 mb-6">
                        <li>توفير وتحسين خدماتنا</li>
                        <li>معالجة المدفوعات</li>
                        <li>إرسال تحديثات حول الدورات</li>
                        <li>الرد على استفساراتك</li>
                    </ul>

                    <h2 class="text-2xl font-heading font-bold text-textDark mb-4 mt-8">حماية معلوماتك</h2>
                    <p class="mb-6">
                        نستخدم تقنيات أمنية متقدمة لحماية معلوماتك الشخصية من الوصول غير المصرح به أو الاستخدام أو الكشف.
                    </p>

                    <h2 class="text-2xl font-heading font-bold text-textDark mb-4 mt-8">مشاركة المعلومات</h2>
                    <p class="mb-6">
                        لا نبيع أو نؤجر معلوماتك الشخصية لأطراف ثالثة. قد نشارك معلوماتك فقط مع مزودي الخدمات الموثوقين الذين يساعدوننا في تشغيل منصتنا.
                    </p>

                    <h2 class="text-2xl font-heading font-bold text-textDark mb-4 mt-8">حقوقك</h2>
                    <p class="mb-4">لديك الحق في:</p>
                    <ul class="list-disc list-inside space-y-2 mb-6">
                        <li>الوصول إلى معلوماتك الشخصية</li>
                        <li>تصحيح معلوماتك</li>
                        <li>حذف حسابك</li>
                        <li>الاعتراض على معالجة معلوماتك</li>
                    </ul>

                    <h2 class="text-2xl font-heading font-bold text-textDark mb-4 mt-8">التواصل معنا</h2>
                    <p class="mb-6">
                        إذا كان لديك أي أسئلة حول سياسة الخصوصية هذه، يرجى التواصل معنا على: <a href="mailto:privacy@example.com" style="color: #04c2eb;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'" class="underline">privacy@example.com</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

