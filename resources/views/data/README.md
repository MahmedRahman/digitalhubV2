# Demo Data للكورسات

هذا الملف يحتوي على Demo Data احترافية للكورسين المتاحين في المنصة.

## الملفات

- `courses.php` - يحتوي على بيانات الكورسين الكاملة

## الكورسات المتاحة

### 1. دبلومة الميديا بير (Media Buyer Diploma)
- **المستوى**: متوسط
- **السعر**: 5500 جنيه
- **الفئة**: الإعلانات المدفوعة

### 2. Advanced Copywriting
- **المستوى**: متقدم
- **السعر**: 2500 جنيه
- **الفئة**: كتابة المحتوى التسويقي

## كيفية الاستخدام

### في Blade Views

```php
@php
    $coursesData = require resource_path('views/data/courses.php');
    $course = $coursesData[0]; // الكورس الأول
@endphp

<h1>{{ $course['hero_title'] }}</h1>
<p>{{ $course['short_description'] }}</p>
```

### في Controllers

```php
use Illuminate\Support\Facades\File;

$coursesData = require resource_path('views/data/courses.php');
$course = collect($coursesData)->firstWhere('id', $id);
```

## هيكل البيانات

كل كورس يحتوي على:

### Course Card Data
- `id` - معرف الكورس
- `title` - عنوان الكورس
- `short_description` - وصف قصير (سطرين)
- `level` - المستوى (متوسط/متقدم)
- `duration` - المدة
- `lessons_count` - عدد الدروس
- `price` - السعر
- `currency` - العملة
- `category` - الفئة
- `primary_cta_text` - نص CTA الأساسي
- `secondary_cta_text` - نص CTA الثانوي

### Course Details Data
- `hero_title` - العنوان الرئيسي
- `hero_subtitle` - العنوان الفرعي
- `stats_bar` - شريط الإحصائيات
- `course_overview` - نظرة عامة (فقرتين)
- `learning_outcomes` - النتائج التعليمية (5-7 نقاط)
- `course_outline` - المنهج (Accordion-ready)
- `who_is_this_for` - لمن هذا الكورس (3-4 نقاط)
- `final_cta_block` - CTA النهائي

## ملاحظات

- البيانات جاهزة للاستخدام مباشرة
- المحتوى عربي احترافي بسيط
- بدون مبالغة تسويقية
- CTA هادئ وواضح

