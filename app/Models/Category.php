<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;

    public $translatable = ['name'];

    protected $guarded = ['id'];

    protected $fillable = ['parent_id', 'name'];

    public static function headerCategories()
    {
        return Cache::remember('header_categories', 2592000, function () {
            return Category::with('childrens')
                ->where('parent_id', null)
                ->get();
        });
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id');
    }

    public function isLastLevelChild()
    {
        return $this->childrens()->count() == 0;
    }

    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('childrens');
    }
}
