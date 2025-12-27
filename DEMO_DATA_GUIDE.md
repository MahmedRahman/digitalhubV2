# دليل Demo Data للكورسات

## نظرة عامة

تم إنشاء Demo Data احترافية للكورسين المتاحين في المنصة:
1. **دبلومة الميديا بير** - 5500 جنيه
2. **Advanced Copywriting** - 2500 جنيه

## الملفات

### البيانات
- `resources/views/data/courses.php` - ملف PHP يحتوي على جميع بيانات الكورسين

### الـ Views المحدثة
- `resources/views/home.blade.php` - الصفحة الرئيسية
- `resources/views/courses/index.blade.php` - قائمة الكورسات
- `resources/views/courses/show.blade.php` - تفاصيل الكورس

## هيكل البيانات

### Course Card Fields
```php
[
    'id' => 1,
    'title' => 'دبلومة الميديا بير',
    'short_description' => '...',
    'level' => 'متوسط',
    'duration' => '80 ساعة',
    'lessons_count' => 45,
    'price' => 5500,
    'currency' => 'جنيه',
    'category' => 'marketing',
    'primary_cta_text' => 'اعرف التفاصيل',
    'secondary_cta_text' => 'اطّلع على المنهج',
]
```

### Course Details Fields
```php
[
    'hero_title' => '...',
    'hero_subtitle' => '...',
    'stats_bar' => [...],
    'course_overview' => [...],
    'learning_outcomes' => [...],
    'course_outline' => [...],
    'who_is_this_for' => [...],
    'final_cta_block' => [...],
]
```

## كيفية الاستخدام

### في Blade View

```blade
@php
    $coursesData = require resource_path('views/data/courses.php');
    $courses = array_map(function($course) {
        return [
            'id' => $course['id'],
            'title' => $course['title'],
            // ... other fields
        ];
    }, $coursesData);
@endphp

@foreach($courses as $course)
    <div>{{ $course['title'] }}</div>
@endforeach
```

### في Controller

```php
public function show($id)
{
    $coursesData = require resource_path('views/data/courses.php');
    $course = collect($coursesData)->firstWhere('id', $id);
    
    if (!$course) {
        abort(404);
    }
    
    return view('courses.show', compact('course'));
}
```

## المحتوى

- **لغة عربية احترافية** - بسيطة وواضحة
- **بدون مبالغة تسويقية** - واقعي وموثوق
- **CTA هادئ** - "اعرف التفاصيل"، "ابدأ رحلتك"
- **محتوى قابل للاستخدام** - حتى لو Demo

## التحديثات المستقبلية

عند ربط بقاعدة بيانات حقيقية:
1. استبدل `require resource_path('views/data/courses.php')` بـ Model calls
2. احتفظ بنفس هيكل البيانات
3. البيانات الحالية جاهزة للاستخدام كـ Seed Data

