<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $primaryKey = 'id';

    protected $fillable = [
       'id',
       'blog_title',
       'slug',
       'image1',
       'image2',
       'image3',
       'image4',
       'image5',
       'blog_para_1',
       'blog_para_2',
       'blog_para_3',
       'author',
       'date',
       'category_id'
    ];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            $blog->slug = Str::slug($blog->blog_title);
        });
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }
}
