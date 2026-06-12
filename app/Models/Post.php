<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Tags\HasTags;

class Post extends Model
{
    use HasFactory, SoftDeletes, Sluggable, HasTags;

    protected $fillable = ['title', 'body', 'image', 'user_id']; // do NOT add 'slug' here

    public function sluggable(): array
    {
        return [
            'slug' => ['source' => 'title']
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
