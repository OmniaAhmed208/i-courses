<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cats = [
            ['development', ['web development', 'game development', 'mobile app', 'databases', 'programming languages', 'software testing', 'software engineering', 'e-commerce']],
            ['business', ['finance', 'entrepreneurship', 'strategy', 'real estate', 'home business', 'communications', 'industry']],
            ['it & software', ['it certification', 'hardware', 'network & security', 'operating systems']],
            ['finance & accounting', ['accounting & bookkeeping', 'cryptocurrency & blockchain', 'economics', 'investing & trading']],
            ['design', ['graphic design', 'web design', 'design tools', '3d & animation', 'user experience']],
            ['personal development', ['personal transformation', 'productivity', 'leadership', 'personal finance', 'career development', 'parenting & relationships', 'Happiness']],
            ['marketing', ['digital marketing', 'search engine optimization', 'social media marketing', 'branding', 'video & mobile marketing', 'affiliate marketing', 'growth hacking']],
            ['health & fitness', ['fitness', 'sports', 'dieting', 'self defense', 'meditation', 'mental health', 'yoga', 'dance']],
            ['photography', ['digital photography', 'photography fundamentals', 'commercial photography', 'video design', 'photography tools']]
        ];

        foreach ($cats as $cat) {
            $category = Category::create([
                'name' => $cat[0]
            ]);
            foreach ($cat[1] as $sub_cat) {
                Category::create([
                    'parent_id' => $category->id,
                    'name' => $sub_cat
                ]);
            }
        }
    }
}
