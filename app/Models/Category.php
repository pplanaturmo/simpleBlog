<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia,hasSlug;

    protected $fillable = ['name','slug'];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('categoryImages')
            // ->useDisk('public')
            ->singleFile();
    }
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
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
}
