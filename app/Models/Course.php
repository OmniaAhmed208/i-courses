<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Course extends Model implements Viewable
{
    use InteractsWithViews;
    use HasTranslations;
    use HasSlug;

    const STATUS_REJECTED = 'rejected';
    const STATUS_PENDING = 'pending';
    const STATUS_PUBLISHED = 'published';
    const STATUS_DRAFT = 'draft';
    const STEP_ONE = 'first_step';
    const STEP_TWO = 'second_step';
    const STEP_THREE = 'third_step';


    public $translatable = ['description', 'requirements', 'this_course_for'];

    protected $guarded = ['id'];

    protected $fillable = [
        'category_id',
        'instructor_id',
        'title',
        'slug',
        'description',
        'requirements',
        'price',
        'image',
        'small_image',
        'status',
        'step',
        'total_rate',
        'level',
        'language',
        'total_duration',
        'number_of_sells',
        'expire_after_days'
    ];

    /*====================================== scopes =====================================*/
    public function scopePendingCount($query)
    {
        $count = Cache::remember('pending_courses_count', 2592000, function () use ($query) {
            return $query->where('status', Course::STATUS_PENDING)->count();
        });

        if ($count > 0) {
            return $count;
        }
        return false;
    }

    /*======================================Slug and routing =====================================*/
    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->usingLanguage('en');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImageAttribute($value)
    {
        return asset('storage/' . $value);

    }//end of image attribute

    public function getSmallImageAttribute($value)
    {
        return asset('storage/' . $value);

    }//end of small image attribute

    /*====================================== relations =====================================*/

    public function groups()
    {
        return $this->hasMany(StudentsGroup::class, 'course_id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'student_course', 'course_id', 'student_id')
            ->withPivot('progress', 'expired')
            ->withTimestamps();
    }

    public function generated_students()
    {
        return $this->hasMany(User::class, 'course_id');
    }

    public function rates()
    {
        return $this->hasMany(CourseRate::class, 'course_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sections()
    {
        return $this->hasMany(CourseSection::class, 'course_id');
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, CourseSection::class, 'course_id', 'section_id');
    }

    public function resources()
    {
        return $this->hasMany(Resource::class, 'course_id');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'course_id')->latest();
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'course_id')->latest();
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'course_id')->latest();
    }

    public function qas()
    {
        return $this->hasMany(Qa::class, 'course_id')->with('student')->latest();
    }

    /*====================================== custom methods =====================================*/

    public function approve()
    {
        $this->status = Course::STATUS_PUBLISHED;
        $this->save();
    }

    public function reject()
    {
        $this->status = Course::STATUS_REJECTED;
        $this->save();
    }

    public function draft()
    {
        $this->status = Course::STATUS_DRAFT;
        $this->save();
    }

}
