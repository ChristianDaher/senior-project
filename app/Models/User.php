<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'provider',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'likes')->withTimestamps();
    }

    public function likedPostIds(): Collection
    {
        return $this->likes()->pluck('posts.id');
    }

    public function stars(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'stars')->withTimestamps();
    }

    public function starredPostIds(): Collection
    {
        return $this->stars()->pluck('posts.id');
    }

    public function comments(): HasMany
    {
        return $this->HasMany(Comment::class);
    }

    public function commentedPostIds(): Collection
    {
        return $this->comments()->pluck('post_id')->unique()->values();
    }

    public function prompts(): HasMany
    {
        return $this->hasMany(Prompt::class);
    }
}
