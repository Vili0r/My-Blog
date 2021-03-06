<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
    use HasFactory, HasSlug;
    use InteractsWithMedia;

    protected $fillable = [
        'cover_image',
        'title',
        'slug',
        'body',
        'published_at',
        'featured',
        'user_id',
        'category_id'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(368)
              ->height(232)
              ->sharpen(10);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }
    
    public function getNumberOfLikesAttribute()
    {
        return $this->likes()->count();
    }

    public function scopeCategory(Builder $query, $category)
    {
        return $query->where('category_id', $category);
    }
    
    public function scopeFeatured(Builder $query)
    {
        return $query->where('featured', 1);
    }
    
    public function scopePublished(Builder $query)
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', new \DateTime());
    } 
    
    public function scopeRecentAsc(Builder $query)
    {
        return $query->orderBy('title', 'asc');
    } 
    
    public function scopeRecentDesc(Builder $query)
    {
        return $query->orderBy('title', 'desc');
    } 
}
