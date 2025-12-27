<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ContentHelper
{
    /**
     * Get homepage content from JSON file
     */
    public static function getHomepageContent()
    {
        $filePath = storage_path('app/content/homepage.json');
        
        if (!File::exists($filePath)) {
            // Return default content if file doesn't exist
            return self::getDefaultHomepageContent();
        }
        
        $content = File::get($filePath);
        return json_decode($content, true);
    }
    
    /**
     * Save homepage content to JSON file
     */
    public static function saveHomepageContent(array $data)
    {
        $filePath = storage_path('app/content/homepage.json');
        $directory = dirname($filePath);
        
        // Create directory if it doesn't exist
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
        
        // Save JSON with pretty print
        File::put($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        return true;
    }
    
    /**
     * Get default homepage content structure
     */
    private static function getDefaultHomepageContent()
    {
        return [
            'hero' => [
                'title' => ['text' => 'تعلم التسويق الرقمي', 'color' => '#FFFFFF', 'fontSize' => '3xl'],
                'subtitle' => ['text' => 'مباشر، تفاعلي وعملي بالكامل', 'color' => '#FFFFFF', 'fontSize' => 'lg'],
                'button1' => ['text' => 'تصفح الكورسات', 'backgroundColor' => '#FFFFFF', 'textColor' => '#111111', 'borderColor' => '#111111'],
                'button2' => ['text' => 'سجل معنا', 'backgroundColor' => '#111111', 'textColor' => '#FFFFFF'],
                'backgroundColor' => '#04c2eb'
            ],
            'about' => [
                'badge' => ['text' => 'من نحن؟ تعرف علينا', 'color' => '#04c2eb'],
                'title' => ['text' => 'نقدم محتوى تعليمي عربي عالي الجودة', 'color' => '#111111', 'fontSize' => '4xl'],
                'description' => ['text' => 'منصة تعليمية تهدف لمساعدتك على النجاح في مجال التسويق الرقمي...', 'color' => '#111111'],
                'button' => ['text' => 'اعرف اكثر', 'backgroundColor' => '#FFFFFF', 'textColor' => '#111111', 'borderColor' => '#111111'],
                'backgroundColor' => '#FFFFFF'
            ]
        ];
    }
    
    /**
     * Get about page content from JSON file
     */
    public static function getAboutContent()
    {
        $filePath = storage_path('app/content/about.json');
        
        if (!File::exists($filePath)) {
            // Return default content if file doesn't exist
            return self::getDefaultAboutContent();
        }
        
        $content = File::get($filePath);
        return json_decode($content, true);
    }
    
    /**
     * Save about page content to JSON file
     */
    public static function saveAboutContent(array $data)
    {
        $filePath = storage_path('app/content/about.json');
        $directory = dirname($filePath);
        
        // Create directory if it doesn't exist
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
        
        // Save JSON with pretty print
        File::put($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        return true;
    }
    
    /**
     * Get default about page content structure
     */
    private static function getDefaultAboutContent()
    {
        return [
            'about_platform' => [
                'title' => ['text' => 'عن المنصة'],
                'description' => ['text' => 'منصة تعليمية عربية متخصصة في تقديم دورات تدريبية عالية الجودة في مختلف المجالات التقنية والمهنية. نسعى لتمكين الأفراد من تطوير مهاراتهم ومعارفهم من خلال محتوى تعليمي شامل ومتخصص.']
            ],
            'vision' => [
                'title' => ['text' => 'رؤيتنا'],
                'description' => ['text' => 'نطمح لأن نكون المنصة التعليمية العربية الرائدة في تقديم محتوى تعليمي عالي الجودة يلبي احتياجات المتعلمين في مختلف المجالات التقنية والمهنية. نسعى لبناء مجتمع تعليمي قوي يساهم في تطوير المهارات والمعارف.']
            ],
            'mission' => [
                'title' => ['text' => 'رسالتنا'],
                'description' => ['text' => 'نسعى إلى تمكين الأفراد من تطوير مهاراتهم ومعارفهم من خلال دورات تدريبية شاملة يقدمها خبراء في مجالاتهم. نؤمن بأن التعليم المستمر هو مفتاح النجاح في عالم اليوم المتغير بسرعة.']
            ],
            'what_makes_us_special' => [
                'badge' => ['text' => 'ما يميزنا'],
                'title' => ['text' => 'نقدم محتوى تفاعلي مباشر بشكل عملي لطلابنا!'],
                'description' => ['text' => 'إكتسب مهارات عملية ومعرفة عميقة من خلال دوراتنا المباشرة والتفاعلية التي تربط بدورها بين الدراسة النظرية والتطبيق العملي.'],
                'button' => ['text' => 'تعلم معنا', 'link' => '/courses'],
                'feature1' => [
                    'title' => 'منهج شامل',
                    'description' => 'صممت دوراتنا لتبدأ معك من المستوى المبتدئ لتصل بك إلى المستوى الاحترافي، وذلك من خلال اكتساب جميع المهارات اللازمة لذلك.'
                ],
                'feature2' => [
                    'title' => 'دورات مباشرة وتفاعلية',
                    'description' => 'تفاعل مباشر مع المحاضرين والزملاء، لضمان تجربة تعلم مرنة وتعاونية.'
                ],
                'feature3' => [
                    'title' => 'الدعم المهني والاستشارات',
                    'description' => 'نقدم دعم فني واستشارات لطلابنا لمساعدتهم على تخطي التحديات المهنية في سوق العمل.'
                ],
                'feature4' => [
                    'title' => 'مشاريع عملية',
                    'description' => 'من خلال تطبيق المحتوى النظري الذي تعلمته إلى مهام عملية وواقعية.'
                ]
            ],
            'trainers' => [
                'badge' => ['text' => 'المدربين'],
                'title' => ['text' => 'محاضرينا على أعلى مستوى من الاحترافية'],
                'description' => ['text' => 'محاضرينا أكثر من كونهم معلمين، فهم محترفون يمتلكون سنوات من الخبرة في مجال التسويق الرقمي. يقدم المحاضرون معرفتهم الواسعة وخبرتهم العملية لتقديم تجربة تعليمية غنية لجميع المتدربين. ويمتلك المحاضرون سجل مثبت من النجاح في مجالات تخصصهم، ويكرسون جهودهم لمساعدة المتعلمين على تحقيق أهدافهم.']
            ],
            'faq' => [
                'badge' => ['text' => 'أسئلة شائعة'],
                'title' => ['text' => 'هل لديك أي استفسارات؟<br>يُمكنك إيجاد الإجابة هنا'],
                'button' => ['text' => 'تعلم معنا', 'link' => '/courses'],
                'items' => [
                    [
                        'question' => 'هل متاح إمكانية التقسيط؟',
                        'answer' => 'نعم، نوفر خيارات تقسيط مرنة لمساعدتك في الاشتراك في الدورات. يمكنك التواصل معنا لمعرفة المزيد عن خيارات التقسيط المتاحة.'
                    ],
                    [
                        'question' => 'ما هي طرق الدفع المتاحة؟',
                        'answer' => 'نوفر عدة طرق دفع آمنة ومريحة بما في ذلك الدفع بالبطاقات الائتمانية، التحويل البنكي، والمحافظ الإلكترونية.'
                    ],
                    [
                        'question' => 'هل يمكنني مشاهدة المحاضرات أكثر من مرة؟',
                        'answer' => 'نعم، بمجرد الاشتراك في الدورة، ستحصل على وصول مدى الحياة للمحتوى ويمكنك مشاهدته في أي وقت وبأي عدد من المرات.'
                    ],
                    [
                        'question' => 'هل يمكنني مشاركة حسابي مع المقربين لي؟',
                        'answer' => 'لا، الحساب شخصي ولا يمكن مشاركته. كل حساب مخصص لشخص واحد فقط لضمان جودة التعلم وحماية حقوق الملكية الفكرية.'
                    ],
                    [
                        'question' => 'ماذا لو فاتتني محاضرة أثناء الكورس؟',
                        'answer' => 'جميع المحاضرات مسجلة ومتاحة للمشاهدة في أي وقت. يمكنك متابعة المحتوى حسب جدولك الخاص.'
                    ],
                    [
                        'question' => 'ما نوع الشهادة التي سأحصل عليها؟',
                        'answer' => 'ستحصل على شهادة إتمام معتمدة من المنصة بعد إتمام جميع متطلبات الدورة بنجاح.'
                    ],
                    [
                        'question' => 'هل المحاضرات مباشرة أم مسجلة؟',
                        'answer' => 'نوفر كلا النوعين. بعض الدورات تحتوي على محاضرات مباشرة تفاعلية، بينما البعض الآخر مسجل ويمكن مشاهدته في أي وقت.'
                    ],
                    [
                        'question' => 'هل أحتاج إلى خبرة سابقة بمجال التسويق الإلكتروني؟',
                        'answer' => 'لا، دوراتنا مصممة لتناسب جميع المستويات من المبتدئين إلى المتقدمين. كل دورة توضح المستوى المطلوب في الوصف.'
                    ]
                ]
            ]
        ];
    }
    
    /**
     * Get contact page content from JSON file
     */
    public static function getContactContent()
    {
        $filePath = storage_path('app/content/contact.json');
        
        if (!File::exists($filePath)) {
            // Return default content if file doesn't exist
            return self::getDefaultContactContent();
        }
        
        $content = File::get($filePath);
        return json_decode($content, true);
    }
    
    /**
     * Save contact page content to JSON file
     */
    public static function saveContactContent(array $data)
    {
        $filePath = storage_path('app/content/contact.json');
        $directory = dirname($filePath);
        
        // Create directory if it doesn't exist
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
        
        // Save JSON with pretty print
        File::put($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        return true;
    }
    
    /**
     * Get default contact page content structure
     */
    private static function getDefaultContactContent()
    {
        return [
            'hero' => [
                'title' => ['text' => 'تواصل معنا'],
                'description' => ['text' => 'نحن هنا لمساعدتك. تواصل معنا لأي استفسارات أو مساعدة، وسنكون سعداء بالرد عليك في أقرب وقت ممكن.']
            ],
            'form' => [
                'title' => ['text' => 'أرسل لنا رسالة'],
                'description' => ['text' => 'املأ النموذج أدناه وسنتواصل معك في أقرب وقت ممكن.']
            ],
            'contact_info' => [
                'title' => ['text' => 'معلومات التواصل'],
                'email' => [
                    'label' => 'البريد الإلكتروني',
                    'value' => 'info@example.com'
                ],
                'phone' => [
                    'label' => 'الهاتف',
                    'value' => '+966 50 123 4567'
                ],
                'address' => [
                    'label' => 'العنوان',
                    'value' => 'الرياض، المملكة العربية السعودية'
                ]
            ],
            'faq' => [
                'title' => ['text' => 'الأسئلة الشائعة'],
                'description' => ['text' => 'إجابات على الأسئلة الأكثر شيوعاً'],
                'items' => [
                    [
                        'question' => 'كيف يمكنني التسجيل في دورة؟',
                        'answer' => 'يمكنك التسجيل في أي دورة من خلال زيارة صفحة الدورة والضغط على زر "سجل الآن". ستحتاج إلى إنشاء حساب أولاً إذا لم يكن لديك حساب.'
                    ],
                    [
                        'question' => 'هل يمكنني الوصول للمحتوى بعد انتهاء الدورة؟',
                        'answer' => 'نعم، عند التسجيل في أي دورة، ستحصل على وصول مدى الحياة للمحتوى. يمكنك العودة في أي وقت ومشاهدة الدروس مرة أخرى.'
                    ],
                    [
                        'question' => 'هل أحصل على شهادة بعد إتمام الدورة؟',
                        'answer' => 'نعم، بعد إتمام جميع دروس الدورة وإكمال جميع المهام، ستحصل على شهادة إتمام معتمدة يمكنك تحميلها وطباعتها.'
                    ],
                    [
                        'question' => 'ما هي طرق الدفع المتاحة؟',
                        'answer' => 'نقبل الدفع عبر البطاقات الائتمانية، التحويل البنكي، والدفع عند الاستلام في بعض المناطق.'
                    ],
                    [
                        'question' => 'هل يمكنني استرداد المبلغ إذا لم أكن راضياً؟',
                        'answer' => 'نعم، نقدم ضمان استرداد المبلغ خلال 30 يوماً من تاريخ الشراء إذا لم تكن راضياً عن الدورة.'
                    ],
                    [
                        'question' => 'كيف يمكنني التواصل مع المدرب؟',
                        'answer' => 'يمكنك التواصل مع المدرب من خلال منصة التعلم. كل دورة تحتوي على قسم للأسئلة والمناقشات حيث يمكنك طرح أسئلتك.'
                    ]
                ]
            ]
        ];
    }
    
    /**
     * Get site settings from JSON file
     */
    public static function getSiteSettings()
    {
        $filePath = storage_path('app/content/settings.json');
        
        if (!File::exists($filePath)) {
            // Return default settings if file doesn't exist
            return self::getDefaultSiteSettings();
        }
        
        $content = File::get($filePath);
        return json_decode($content, true);
    }
    
    /**
     * Save site settings to JSON file
     */
    public static function saveSiteSettings(array $data)
    {
        $filePath = storage_path('app/content/settings.json');
        $directory = dirname($filePath);
        
        // Create directory if it doesn't exist
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
        
        // Save JSON with pretty print
        File::put($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        return true;
    }
    
    /**
     * Get default site settings structure
     */
    private static function getDefaultSiteSettings()
    {
        return [
            'site_name' => 'Digital Hub Academy',
            'email' => 'info@example.com',
            'phone' => '+966 50 123 4567',
            'whatsapp' => '+966501234567',
            'address' => 'الرياض، المملكة العربية السعودية',
            'social_media' => [
                'youtube' => '',
                'facebook' => '',
                'instagram' => '',
                'linkedin' => '',
                'twitter' => ''
            ]
        ];
    }
    
    /**
     * Get all courses from JSON file
     */
    public static function getCourses()
    {
        $filePath = storage_path('app/content/courses.json');
        
        if (!File::exists($filePath)) {
            // Return default courses if file doesn't exist
            return self::getDefaultCourses();
        }
        
        $content = File::get($filePath);
        $courses = json_decode($content, true);
        
        // If JSON decode failed or returned null, return default courses
        if ($courses === null || !is_array($courses)) {
            return self::getDefaultCourses();
        }
        
        return $courses;
    }
    
    /**
     * Save courses to JSON file
     */
    public static function saveCourses(array $courses)
    {
        $filePath = storage_path('app/content/courses.json');
        $directory = dirname($filePath);
        
        // Create directory if it doesn't exist
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
        
        // Save JSON with pretty print
        File::put($filePath, json_encode($courses, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        return true;
    }
    
    /**
     * Get a single course by ID
     */
    public static function getCourse($id)
    {
        $courses = self::getCourses();
        foreach ($courses as $course) {
            if (isset($course['id']) && $course['id'] == $id) {
                return $course;
            }
        }
        return null;
    }
    
    /**
     * Add a new course
     */
    public static function addCourse(array $courseData)
    {
        $courses = self::getCourses();
        
        // Generate new ID
        $maxId = 0;
        foreach ($courses as $course) {
            if (isset($course['id']) && $course['id'] > $maxId) {
                $maxId = $course['id'];
            }
        }
        $courseData['id'] = $maxId + 1;
        
        // Add created_at timestamp
        $courseData['created_at'] = now()->toDateTimeString();
        $courseData['updated_at'] = now()->toDateTimeString();
        
        $courses[] = $courseData;
        self::saveCourses($courses);
        
        return $courseData['id'];
    }
    
    /**
     * Update an existing course
     */
    public static function updateCourse($id, array $courseData)
    {
        $courses = self::getCourses();
        
        foreach ($courses as $index => $course) {
            if (isset($course['id']) && $course['id'] == $id) {
                $courseData['id'] = $id;
                $courseData['created_at'] = $course['created_at'] ?? now()->toDateTimeString();
                $courseData['updated_at'] = now()->toDateTimeString();
                $courses[$index] = $courseData;
                self::saveCourses($courses);
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Delete a course
     */
    public static function deleteCourse($id)
    {
        $courses = self::getCourses();
        $newCourses = [];
        
        foreach ($courses as $course) {
            if (!isset($course['id']) || $course['id'] != $id) {
                $newCourses[] = $course;
            }
        }
        
        self::saveCourses($newCourses);
        return true;
    }
    
    /**
     * Get default courses structure
     */
    private static function getDefaultCourses()
    {
        return [
            [
                'id' => 1,
                'slug' => 'media-buyer-diploma',
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
                ],
                'course_outline' => [
                    [
                        'title' => 'مقدمة في الميديا بيرينج',
                        'lessons' => [
                            ['title' => 'ما هو الميديا بيرينج؟', 'duration' => '20 دقيقة'],
                            ['title' => 'مهارات الميديا بير الناجح', 'duration' => '25 دقيقة'],
                        ],
                    ],
                ],
                'who_is_this_for' => [
                    'من يريد العمل كميديا بير في شركات أو كـ Freelancer',
                    'مسوقين رقميين يريدون التخصص في الإعلانات المدفوعة',
                ],
                'final_cta_block' => [
                    'headline' => 'ابدأ رحلتك كميديا بير محترف',
                    'text' => 'انضم إلى الكورس وابدأ في بناء مهاراتك العملية. ستحصل على دعم مستمر ومشاريع حقيقية لبناء Portfolio قوي.',
                    'button_text' => 'سجل الآن',
                ],
                'status' => 'active',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ]
        ];
    }
    
    /**
     * Get all blog posts
     */
    public static function getBlogPosts()
    {
        $filePath = storage_path('app/content/blog.json');
        
        if (!File::exists($filePath)) {
            // Return default blog posts if file doesn't exist
            return self::getDefaultBlogPosts();
        }
        
        $content = File::get($filePath);
        $posts = json_decode($content, true);
        
        // If JSON decode failed or returned null, return default posts
        if ($posts === null || !is_array($posts)) {
            return self::getDefaultBlogPosts();
        }
        
        return $posts;
    }
    
    /**
     * Save blog posts to JSON file
     */
    public static function saveBlogPosts(array $posts)
    {
        $filePath = storage_path('app/content/blog.json');
        $directory = dirname($filePath);
        
        // Create directory if it doesn't exist
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
        
        // Save JSON with pretty print
        File::put($filePath, json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        
        return true;
    }
    
    /**
     * Get a single blog post by ID
     */
    public static function getBlogPost($id)
    {
        $posts = self::getBlogPosts();
        foreach ($posts as $post) {
            if (isset($post['id']) && $post['id'] == $id) {
                return $post;
            }
        }
        return null;
    }
    
    /**
     * Add a new blog post
     */
    public static function addBlogPost(array $postData)
    {
        $posts = self::getBlogPosts();
        
        // Generate new ID
        $maxId = 0;
        foreach ($posts as $post) {
            if (isset($post['id']) && $post['id'] > $maxId) {
                $maxId = $post['id'];
            }
        }
        $postData['id'] = $maxId + 1;
        
        // Add created_at timestamp
        $postData['created_at'] = now()->toDateTimeString();
        $postData['updated_at'] = now()->toDateTimeString();
        
        $posts[] = $postData;
        self::saveBlogPosts($posts);
        
        return $postData['id'];
    }
    
    /**
     * Update an existing blog post
     */
    public static function updateBlogPost($id, array $postData)
    {
        $posts = self::getBlogPosts();
        
        foreach ($posts as $index => $post) {
            if (isset($post['id']) && $post['id'] == $id) {
                $postData['id'] = $id;
                $postData['created_at'] = $post['created_at'] ?? now()->toDateTimeString();
                $postData['updated_at'] = now()->toDateTimeString();
                $posts[$index] = $postData;
                self::saveBlogPosts($posts);
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Delete a blog post
     */
    public static function deleteBlogPost($id)
    {
        $posts = self::getBlogPosts();
        $newPosts = [];
        
        foreach ($posts as $post) {
            if (!isset($post['id']) || $post['id'] != $id) {
                $newPosts[] = $post;
            }
        }
        
        self::saveBlogPosts($newPosts);
        return true;
    }
    
    /**
     * Get default blog posts structure
     */
    private static function getDefaultBlogPosts()
    {
        return [
            [
                'id' => 1,
                'title' => 'كيف تبدأ في تعلم البرمجة؟',
                'slug' => 'how-to-start-programming',
                'excerpt' => 'دليل شامل للمبتدئين في عالم البرمجة. تعرف على الخطوات الأولى والموارد المفيدة.',
                'content' => '<p>هذا مقال شامل عن كيفية البدء في تعلم البرمجة...</p>',
                'author' => 'أحمد محمد',
                'date' => '2024-01-10',
                'read_time' => '5 دقائق',
                'category' => 'برمجة',
                'status' => 'published',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ],
            [
                'id' => 2,
                'title' => 'أساسيات تصميم واجهات المستخدم',
                'slug' => 'ui-design-basics',
                'excerpt' => 'تعلم المبادئ الأساسية لتصميم واجهات مستخدم جذابة وسهلة الاستخدام.',
                'content' => '<p>هذا مقال عن أساسيات تصميم واجهات المستخدم...</p>',
                'author' => 'فاطمة علي',
                'date' => '2024-01-08',
                'read_time' => '7 دقائق',
                'category' => 'تصميم',
                'status' => 'published',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ],
            [
                'id' => 3,
                'title' => 'استراتيجيات التسويق الرقمي الفعال',
                'slug' => 'digital-marketing-strategies',
                'excerpt' => 'اكتشف أفضل استراتيجيات التسويق الرقمي التي تساعدك في الوصول إلى جمهورك المستهدف.',
                'content' => '<p>هذا مقال عن استراتيجيات التسويق الرقمي...</p>',
                'author' => 'محمد خالد',
                'date' => '2024-01-05',
                'read_time' => '10 دقائق',
                'category' => 'تسويق',
                'status' => 'published',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ]
        ];
    }
}

