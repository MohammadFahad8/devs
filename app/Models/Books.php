<?php

namespace App\Models;

use App\Scopes\AuthorScope;
use App\Events\SendEmailAuthor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Books extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'tags'];
    protected $dispatchesEvents = [
        'created' => SendEmailAuthor::class,
    ];
    //Global Scope
    // protected static function booted()
    // {
    //     static::addGlobalScope(new AuthorScope);
    // }

    //Local Scope

    public function scopeAuthor($query)
    {
        return $query->where('title', '!=', 'Friday assignee');
    }

    public function scopeSearch(Builder $query,$search)
    {
        return $query->where("title",'ILIKE','%'.$search.'%');
    }
    public static function fatModel(): Collection
    {
        return Books::latest()->get();
    }
}
