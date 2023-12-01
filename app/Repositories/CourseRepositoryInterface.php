<?php

namespace App\Repositories;

interface CourseRepositoryInterface
{
    public function search($search_word);

    public function get_by_slug($slug);

    public function sections($slug);

    public function resources($slug);

    public function latest_courses_widget($slug);

    public function all($request);

    public function my_courses();
}
