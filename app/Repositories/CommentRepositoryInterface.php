<?php

namespace App\Repositories;

interface CommentRepositoryInterface
{
    public function first_three($course_id);

    public function all($course_id);

    public function store($data, $course);
}
