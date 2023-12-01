<?php

use App\Models\Course;
use App\Models\CourseSection;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $coruse = Course::create([
            'title' => ['en' => 'Test Course', 'ar' => 'كورس للإختبار'],
            'description' => ['en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'ar' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد'],
            'requirements' => ['en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'ar' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد'],
            'category_id' => 1,
            'instructor_id' => 2,
            'price' => 150,
            'small_image' => 'images/small-img.jpg',
            'image' => 'images/img8.jpg',
            'level' => 'beginner',
            'language' => 'arabic'
        ]);

        $sections = [
            'Fundamentals of Digital Marketing',
            'Microsoft Excel - Quick Introduction',
            'Content Marketing',
            'Mobile Marketing',
            'PPC',
            'SEO',
            'Video Marketing',
            'Customer Management',
            'Social Media Marketing',
            'Conclusion'
        ];
        foreach ($sections as $section) {
            $sec = CourseSection::create([
                'course_id' => $coruse->id,
                'name' => $section
            ]);
            for ($i = 0; $i < 5; $i++) {
                Lesson::create([
                    'name' => 'Test-' . ($i + 1),
                    'link' => 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4',
                    'time' => 1100,
                    'section_id' => $sec->id,
                    'type' => 'link'
                ]);
            }
        }
    }
}
