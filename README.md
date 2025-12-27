# منصة تعليمية عربية RTL

منصة تعليمية عربية كاملة باستخدام Laravel + Blade Templates + Tailwind CSS + Vanilla JS.

## المميزات

- ✅ تصميم بسيط وموثوق (Minimal/Clean/Trust-based)
- ✅ دعم كامل للغة العربية RTL
- ✅ نظام ألوان موحد (Primary/Neutral/Accent)
- ✅ Responsive Design (Mobile-first)
- ✅ تفاعلات Vanilla JS (Mobile Menu, Tabs, Accordion)
- ✅ Production-ready وقابل للتوسع

## التقنيات المستخدمة

- **Backend**: Laravel 12
- **Frontend**: Blade Templates
- **Styling**: Tailwind CSS 3
- **JavaScript**: Vanilla JS
- **Build Tool**: Vite

## التثبيت والتشغيل

### المتطلبات

- PHP >= 8.2
- Composer
- Node.js >= 18
- npm

### خطوات التثبيت

1. تثبيت dependencies PHP:
```bash
composer install
```

2. تثبيت dependencies Node:
```bash
npm install
```

3. نسخ ملف البيئة:
```bash
cp .env.example .env
```

4. توليد مفتاح التطبيق:
```bash
php artisan key:generate
```

5. بناء assets:
```bash
npm run build
```

أو للتطوير مع hot reload:
```bash
npm run dev
```

6. تشغيل الخادم:
```bash
php artisan serve
```

الموقع سيكون متاحاً على: `http://localhost:8000`

## هيكل المشروع

```
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php          # Base layout
│   ├── partials/
│   │   ├── navbar.blade.php       # Navigation bar
│   │   └── footer.blade.php       # Footer
│   ├── home.blade.php             # Home page
│   ├── courses/
│   │   ├── index.blade.php         # Courses listing
│   │   └── show.blade.php         # Course details
│   ├── blog/
│   │   ├── index.blade.php         # Blog listing
│   │   └── show.blade.php         # Blog post
│   ├── about.blade.php            # About page
│   ├── contact.blade.php          # Contact page
│   └── legal/
│       ├── privacy.blade.php      # Privacy policy
│       └── terms.blade.php         # Terms & conditions
├── css/
│   └── app.css                    # Tailwind + Custom styles
└── js/
    └── app.js                     # Vanilla JS interactions
```

## نظام الألوان

- **Primary**: `#1e3a5f` (أزرق غامق) - للعناوين والروابط
- **Neutral**: درجات رمادي - للخلفيات والنصوص
- **Accent**: `#f59e0b` (Amber/برتقالي) - للـ CTA فقط

## الخطوط

- **Cairo**: للعناوين (Headings)
- **Tajawal**: للنصوص (Body)

## الصفحات المتاحة

- `/` - الصفحة الرئيسية
- `/courses` - قائمة الدورات
- `/courses/{id}` - تفاصيل الدورة
- `/blog` - المدونة
- `/blog/{id}` - مقال
- `/about` - عن المنصة
- `/contact` - اتصل بنا
- `/privacy` - سياسة الخصوصية
- `/terms` - الشروط والأحكام

## ملاحظات

- البيانات الحالية هي Dummy data ويمكن استبدالها بقاعدة بيانات حقيقية
- جميع التفاعلات تعمل بـ Vanilla JS بدون أي مكتبات إضافية
- التصميم Responsive بالكامل ويعمل على جميع الأجهزة

## التطوير المستقبلي

- إضافة Authentication & Authorization
- ربط بقاعدة بيانات حقيقية
- إضافة نظام الدفع
- إضافة لوحة تحكم للمدرسين
- إضافة نظام التعليقات والتقييمات
