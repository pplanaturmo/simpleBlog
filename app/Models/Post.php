<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
class Post extends Model implements HasMedia,Feedable
{
    use HasFactory,InteractsWithMedia,HasSlug;

    protected $fillable = ['user_id','category_id','image_id','slug','title','content','is_published'];

    protected $casts = [
        'is_published'=> 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('postImages')
            // ->useDisk('public')
            ->singleFile();
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
    return $this->belongsTo(Category::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
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

    //metodo para rss
    public function toFeedItem(): FeedItem
    {


        return FeedItem::create()
            ->id($this->slug)
            ->title($this->title)
            ->updated($this->updated_at)
            ->summary("")
            ->updated($this->updated_at)
            ->link(route('posts.show', $this->slug))
            ->authorName($this->user->name)
            ->authorEmail($this->user->email);
    }

    public static function getFeedItems()
{
   return Post::all();
}
}
