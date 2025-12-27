@extends('layouts.app')

@section('title', 'الشروط والأحكام')
@section('description', 'الشروط والأحكام الخاصة بمنصتنا التعليمية')

@section('content')
    <div class="bg-white py-12 lg:py-16 border-b" style="border-color: #F5F6F7;">
        <div class="container-custom">
            <h1 class="text-3xl lg:text-4xl font-heading font-bold text-textDark mb-4">
                الشروط والأحكام
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
                    <h2 class="text-2xl font-heading font-bold text-textDark mb-4">القبول</h2>
                    <p class="mb-6">
                        باستخدام منصتنا التعليمية، أنت توافق على الالتزام بهذه الشروط والأحكام. إذا كنت لا توافق على أي جزء من هذه الشروط، يرجى عدم استخدام خدماتنا.
                    </p>

                    <h2 class="text-2xl font-heading font-bold text-textDark mb-4 mt-8">استخدام المنصة</h2>
                    <p class="mb-4">عند استخدام منصتنا، يجب عليك:</p>
                    <ul class="list-disc list-inside space-y-2 mb-6">
                        <li>تقديم معلومات دقيقة وصحيحة</li>
                        <li>الحفاظ على سرية حسابك</li>
                        <li>عدم مشاركة محتوى الدورة مع أطراف ثالثة</li>
                        <li>الالتزام بجميع القوانين واللوائح المعمول بها</li>
                    </ul>

                    <h2 class="text-2xl font-heading font-bold text-textDark mb-4 mt-8">الملكية الفكرية</h2>
                    <p class="mb-6">
                        جميع محتويات الدورات والمواد التعليمية محمية بحقوق الطبع والنشر. لا يجوز لك نسخ أو توزيع أو تعديل أي محتوى دون إذن كتابي منا.
                    </p>

                    <h2 class="text-2xl font-heading font-bold text-textDark mb-4 mt-8">المدفوعات والاسترداد</h2>
                    <p class="mb-4">بخصوص المدفوعات:</p>
                    <ul class="list-disc list-inside space-y-2 mb-6">
                        <li>جميع الأسعار بالريال السعودي</li>
                        <li>المدفوعات غير قابلة للاسترداد إلا في حالات محددة</li>
                        <li>نحتفظ بالحق في تغيير الأسعار في أي وقت</li>
                        <li>يمكنك طلب استرداد المبلغ خلال 30 يوماً من الشراء</li>
                    </ul>

                    <h2 class="text-2xl font-heading font-bold text-textDark mb-4 mt-8">إلغاء الحساب</h2>
                    <p class="mb-6">
                        يمكنك إلغاء حسابك في أي وقت. عند الإلغاء، ستفقد الوصول إلى جميع الدورات المشتراة، إلا إذا كان لديك وصول مدى الحياة.
                    </p>

                    <h2 class="text-2xl font-heading font-bold text-textDark mb-4 mt-8">التعديلات</h2>
                    <p class="mb-6">
                        نحتفظ بالحق في تعديل هذه الشروط والأحكام في أي وقت. سيتم إشعارك بأي تغييرات عبر البريد الإلكتروني أو من خلال المنصة.
                    </p>

                    <h2 class="text-2xl font-heading font-bold text-textDark mb-4 mt-8">التواصل معنا</h2>
                    <p class="mb-6">
                        إذا كان لديك أي أسئلة حول هذه الشروط والأحكام، يرجى التواصل معنا على: <a href="mailto:legal@example.com" style="color: #04c2eb;" onmouseover="this.style.opacity='0.8'" onmouseout="this.style.opacity='1'" class="underline">legal@example.com</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

