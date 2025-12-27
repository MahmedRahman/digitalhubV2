<?php

/**
 * Demo Data للكورسات
 * محتوى احترافي بسيط بدون مبالغة تسويقية
 */

return [
    // كورس 1: دبلومة الميديا بير
    [
        'id' => 1,
        'slug' => 'media-buyer-diploma',
        
        // Course Card Data
        'title' => 'دبلومة الميديا بير',
        'short_description' => 'تأهيل شامل لإدارة الحملات الإعلانية على TikTok Ads، Snapchat Ads، Google Ads، وYouTube Ads. كورس عملي مع مشاريع حقيقية.',
        'level' => 'متوسط',
        'level_badge' => 'Intermediate',
        'duration' => '80 ساعة',
        'lessons_count' => 45,
        'price' => 5500,
        'currency' => 'جنيه',
        'category' => 'marketing',
        'category_name' => 'الإعلانات المدفوعة',
        'primary_cta_text' => 'اعرف التفاصيل',
        'secondary_cta_text' => 'محتوى الكورس',
        
        // Course Details Data
        'hero_title' => 'دبلومة الميديا بير',
        'hero_subtitle' => 'تأهيل شامل لإدارة الحملات الإعلانية على منصات متعددة',
        
        'stats_bar' => [
            'duration' => '80 ساعة تدريب',
            'lessons' => '45 درس عملي',
            'level' => 'متوسط',
            'platforms' => '4 منصات إعلانية',
        ],
        
        'course_overview' => [
            'دبلومة شاملة تهدف إلى تأهيلك للعمل كميديا بير محترف. ستتعلم إدارة الحملات الإعلانية على TikTok Ads، Snapchat Ads، Google Ads، وYouTube Ads من الصفر حتى الاحتراف.',
            'الكورس عملي بالكامل. ستعمل على مشاريع حقيقية وتبني Portfolio يثبت مهاراتك. في نهاية الكورس ستكون قادراً على إدارة حملات متعددة المنصات وتحقيق نتائج قابلة للقياس.',
        ],
        
        'learning_outcomes' => [
            'إدارة حملات TikTok Ads من الصفر حتى التحسين المتقدم',
            'إنشاء وإدارة حملات Snapchat Ads بفعالية',
            'إتقان Google Ads (Search, Display, YouTube)',
            'تحليل البيانات وقراءة التقارير لاتخاذ قرارات مدروسة',
            'تحسين الأداء وخفض التكلفة مع رفع معدلات التحويل',
            'بناء Portfolio احترافي يثبت خبرتك',
            'فهم استراتيجيات الميزانية والتخطيط للحملات',
        ],
        
        'course_outline' => [
            [
                'title' => 'مقدمة في الميديا بيرينج',
                'lessons' => [
                    ['title' => 'ما هو الميديا بيرينج؟', 'duration' => '20 دقيقة'],
                    ['title' => 'مهارات الميديا بير الناجح', 'duration' => '25 دقيقة'],
                    ['title' => 'أدوات العمل الأساسية', 'duration' => '30 دقيقة'],
                ],
            ],
            [
                'title' => 'TikTok Ads',
                'lessons' => [
                    ['title' => 'إنشاء حساب إعلاني على TikTok', 'duration' => '30 دقيقة'],
                    ['title' => 'أنواع الإعلانات على TikTok', 'duration' => '35 دقيقة'],
                    ['title' => 'استهداف الجمهور', 'duration' => '40 دقيقة'],
                    ['title' => 'إنشاء أول حملة إعلانية', 'duration' => '45 دقيقة'],
                    ['title' => 'تحليل الأداء والتحسين', 'duration' => '50 دقيقة'],
                ],
            ],
            [
                'title' => 'Snapchat Ads',
                'lessons' => [
                    ['title' => 'نظرة عامة على Snapchat Ads', 'duration' => '30 دقيقة'],
                    ['title' => 'أنواع الإعلانات والمواصفات', 'duration' => '35 دقيقة'],
                    ['title' => 'استراتيجيات الاستهداف', 'duration' => '40 دقيقة'],
                    ['title' => 'إدارة الميزانية والتحسين', 'duration' => '45 دقيقة'],
                ],
            ],
            [
                'title' => 'Google Ads',
                'lessons' => [
                    ['title' => 'مقدمة في Google Ads', 'duration' => '30 دقيقة'],
                    ['title' => 'حملات البحث (Search Campaigns)', 'duration' => '50 دقيقة'],
                    ['title' => 'حملات العرض (Display Campaigns)', 'duration' => '45 دقيقة'],
                    ['title' => 'حملات YouTube', 'duration' => '50 دقيقة'],
                    ['title' => 'الكلمات المفتاحية والـ Bidding', 'duration' => '40 دقيقة'],
                    ['title' => 'تحليل الأداء والـ Conversion Tracking', 'duration' => '45 دقيقة'],
                ],
            ],
            [
                'title' => 'YouTube Ads',
                'lessons' => [
                    ['title' => 'أنواع إعلانات YouTube', 'duration' => '35 دقيقة'],
                    ['title' => 'إنشاء حملات فيديو فعالة', 'duration' => '45 دقيقة'],
                    ['title' => 'استهداف الجمهور على YouTube', 'duration' => '40 دقيقة'],
                    ['title' => 'قياس النتائج والتحسين', 'duration' => '40 دقيقة'],
                ],
            ],
            [
                'title' => 'إدارة متعددة المنصات',
                'lessons' => [
                    ['title' => 'توزيع الميزانية على المنصات', 'duration' => '35 دقيقة'],
                    ['title' => 'تحليل الأداء المقارن', 'duration' => '40 دقيقة'],
                    ['title' => 'استراتيجيات التحسين الشاملة', 'duration' => '45 دقيقة'],
                ],
            ],
            [
                'title' => 'مشروع نهائي وبناء Portfolio',
                'lessons' => [
                    ['title' => 'مشروع عملي شامل', 'duration' => '120 دقيقة'],
                    ['title' => 'بناء Portfolio احترافي', 'duration' => '60 دقيقة'],
                    ['title' => 'تقديم المشروع والمراجعة', 'duration' => '45 دقيقة'],
                ],
            ],
        ],
        
        'who_is_this_for' => [
            'من يريد العمل كميديا بير في شركات أو كـ Freelancer',
            'مسوقين رقميين يريدون التخصص في الإعلانات المدفوعة',
            'أصحاب مشاريع يريدون إدارة حملاتهم بأنفسهم',
            'خريجين جدد يبحثون عن مهارة عملية مطلوبة في السوق',
        ],
        
        'final_cta_block' => [
            'headline' => 'ابدأ رحلتك كميديا بير محترف',
            'text' => 'انضم إلى الكورس وابدأ في بناء مهاراتك العملية. ستحصل على دعم مستمر ومشاريع حقيقية لبناء Portfolio قوي.',
            'button_text' => 'سجل الآن',
        ],
    ],
    
    // كورس 2: Advanced Copywriting
    [
        'id' => 2,
        'slug' => 'advanced-copywriting',
        
        // Course Card Data
        'title' => 'Advanced Copywriting',
        'short_description' => 'تعلم كتابة محتوى تسويقي يبيع. من Landing Pages إلى Ads وSocial Content. سيكولوجية الإقناع مع تطبيق عملي.',
        'level' => 'متقدم',
        'level_badge' => 'Advanced',
        'duration' => '50 ساعة',
        'lessons_count' => 30,
        'price' => 2500,
        'currency' => 'جنيه',
        'category' => 'marketing',
        'category_name' => 'كتابة المحتوى التسويقي',
        'primary_cta_text' => 'اعرف التفاصيل',
        'secondary_cta_text' => 'محتوى الكورس',
        
        // Course Details Data
        'hero_title' => 'Advanced Copywriting',
        'hero_subtitle' => 'كتابة محتوى تسويقي يبيع ويحول',
        
        'stats_bar' => [
            'duration' => '50 ساعة تدريب',
            'lessons' => '30 درس عملي',
            'level' => 'متقدم',
            'platforms' => 'Landing Pages, Ads, Social',
        ],
        
        'course_overview' => [
            'كورس متقدم في كتابة المحتوى التسويقي. ستتعلم كيف تكتب Copy يبيع، من Landing Pages إلى إعلانات السوشيال ميديا. الكورس يجمع بين سيكولوجية الإقناع والتطبيق العملي.',
            'ستعمل على مشاريع حقيقية وتبني Portfolio من أعمالك. في نهاية الكورس ستكون قادراً على كتابة Copy يحول القراء إلى عملاء.',
        ],
        
        'learning_outcomes' => [
            'فهم سيكولوجية الإقناع في الكتابة التسويقية',
            'كتابة Landing Pages تحول الزوار إلى عملاء',
            'إنشاء إعلانات فعالة لـ Social Media Ads',
            'كتابة محتوى Social Media يجذب ويربط',
            'كتابة Video Scripts مقنعة',
            'استخدام Storytelling في التسويق',
            'بناء Portfolio من أعمال Copywriting',
        ],
        
        'course_outline' => [
            [
                'title' => 'أساسيات Copywriting',
                'lessons' => [
                    ['title' => 'ما هو Copywriting؟', 'duration' => '25 دقيقة'],
                    ['title' => 'الفرق بين Copy وContent', 'duration' => '20 دقيقة'],
                    ['title' => 'سيكولوجية الإقناع في الكتابة', 'duration' => '35 دقيقة'],
                ],
            ],
            [
                'title' => 'كتابة Landing Pages',
                'lessons' => [
                    ['title' => 'هيكل Landing Page الفعال', 'duration' => '40 دقيقة'],
                    ['title' => 'كتابة Headlines مقنعة', 'duration' => '35 دقيقة'],
                    ['title' => 'كتابة Body Copy', 'duration' => '45 دقيقة'],
                    ['title' => 'كتابة CTAs فعالة', 'duration' => '30 دقيقة'],
                    ['title' => 'مشروع: Landing Page كاملة', 'duration' => '90 دقيقة'],
                ],
            ],
            [
                'title' => 'إعلانات Social Media',
                'lessons' => [
                    ['title' => 'كتابة إعلانات Facebook & Instagram', 'duration' => '40 دقيقة'],
                    ['title' => 'إعلانات TikTok وSnapchat', 'duration' => '35 دقيقة'],
                    ['title' => 'إعلانات LinkedIn', 'duration' => '30 دقيقة'],
                    ['title' => 'A/B Testing للنسخ', 'duration' => '35 دقيقة'],
                ],
            ],
            [
                'title' => 'محتوى Social Media',
                'lessons' => [
                    ['title' => 'كتابة Posts جذابة', 'duration' => '35 دقيقة'],
                    ['title' => 'Storytelling في Social Media', 'duration' => '40 دقيقة'],
                    ['title' => 'كتابة Captions تحول', 'duration' => '30 دقيقة'],
                    ['title' => 'استراتيجيات المحتوى', 'duration' => '35 دقيقة'],
                ],
            ],
            [
                'title' => 'Video Scripts',
                'lessons' => [
                    ['title' => 'هيكل Video Script', 'duration' => '30 دقيقة'],
                    ['title' => 'كتابة Scripts للإعلانات', 'duration' => '40 دقيقة'],
                    ['title' => 'Scripts للمحتوى التعليمي', 'duration' => '35 دقيقة'],
                ],
            ],
            [
                'title' => 'Storytelling في التسويق',
                'lessons' => [
                    ['title' => 'قوة القصص في التسويق', 'duration' => '35 دقيقة'],
                    ['title' => 'بناء Brand Story', 'duration' => '40 دقيقة'],
                    ['title' => 'استخدام القصص في Copy', 'duration' => '35 دقيقة'],
                ],
            ],
            [
                'title' => 'مشروع نهائي وPortfolio',
                'lessons' => [
                    ['title' => 'مشروع شامل: حملة تسويقية كاملة', 'duration' => '120 دقيقة'],
                    ['title' => 'بناء Portfolio احترافي', 'duration' => '60 دقيقة'],
                    ['title' => 'تقديم المشروع والمراجعة', 'duration' => '45 دقيقة'],
                ],
            ],
        ],
        
        'who_is_this_for' => [
            'كتّاب محتوى يريدون التخصص في Copywriting',
            'مسوقين رقميين يريدون تحسين معدلات التحويل',
            'أصحاب مشاريع يريدون كتابة Copy لأنفسهم',
            'Freelancers يبحثون عن مهارة مطلوبة في السوق',
        ],
        
        'final_cta_block' => [
            'headline' => 'ابدأ رحلتك في Copywriting',
            'text' => 'تعلم كيف تكتب Copy يبيع ويحول. ستحصل على مشاريع عملية وPortfolio يثبت مهاراتك.',
            'button_text' => 'سجل الآن',
        ],
    ],
];

